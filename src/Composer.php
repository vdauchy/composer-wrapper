<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper;

use AssertionError;
use Closure;
use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;
use VDauchy\ComposerWrapper\Commands\CheckPlatformReqsCommand;
use VDauchy\ComposerWrapper\Commands\CreateProjectCommand;
use VDauchy\ComposerWrapper\Commands\HelpCommand;
use VDauchy\ComposerWrapper\Commands\InitCommand;
use VDauchy\ComposerWrapper\Commands\InstallCommand;
use VDauchy\ComposerWrapper\Commands\OptionBag\HelpOptionBag;
use VDauchy\ComposerWrapper\Commands\OptionBag\ShowOptionBag;
use VDauchy\ComposerWrapper\Commands\RemoveCommand;
use VDauchy\ComposerWrapper\Commands\RequireCommand;
use VDauchy\ComposerWrapper\Commands\ShowCommand;
use VDauchy\ComposerWrapper\Commands\UpdateCommand;
use VDauchy\ComposerWrapper\Commands\ValidateCommand;
use VDauchy\ComposerWrapper\Contracts\AnalyserInterface;
use VDauchy\ComposerWrapper\Contracts\CommandInterface;
use VDauchy\ComposerWrapper\Contracts\ComposerInterface;
use VDauchy\ComposerWrapper\Contracts\RunnerInterface;
use VDauchy\ComposerWrapper\Entities\Help;
use VDauchy\ComposerWrapper\Entities\Package;
use VDauchy\ComposerWrapper\Entities\Packages;
use VDauchy\ComposerWrapper\Entities\PlatformRequirements;

class Composer implements ComposerInterface
{
    /**
     * @var Collection
     */
    private Collection $history;

    /**
     * @var RunnerInterface
     */
    private RunnerInterface $executor;

    /**
     * @var AnalyserInterface
     */
    private AnalyserInterface $analyser;

    /**
     * @var Environment
     */
    private Environment $environment;

    /**
     * @var LoggerInterface|null
     */
    private ?LoggerInterface $logger;

    /**
     * @param RunnerInterface $executor
     * @param AnalyserInterface $analyser
     * @param Environment $environment
     * @param LoggerInterface|null $logger
     */
    public function __construct(
        RunnerInterface $executor,
        AnalyserInterface $analyser,
        Environment $environment,
        ?LoggerInterface $logger = null
    ) {
        $this->executor = $executor;
        $this->analyser = $analyser;
        $this->environment = $environment;
        $this->history = collect();
        $this->logger = $logger;
    }

    /**
     * @param Closure $options
     * @return $this|ComposerInterface
     */
    public function env(Closure $options): ComposerInterface
    {
        $options($this->environment);
        return $this;
    }

    /**
     * @param Closure|null $options
     * @return $this
     */
    public function init(?Closure $options = null): ComposerInterface
    {
        $command = (new InitCommand())->withOptions($options);
        tap($this->run($command), fn(Log $log) => $this->analyser->check($log));
        return $this;
    }

    /**
     * @param Closure|null $options
     * @return ComposerInterface
     */
    public function install(?Closure $options = null): ComposerInterface
    {
        $command = (new InstallCommand())->withOptions($options);
        tap($this->run($command), fn(Log $log) => $this->analyser->check($log));
        return $this;
    }

    /**
     * @param string|null $package
     * @param Closure|null $options
     * @return $this|ComposerInterface
     */
    public function update(?string $package = null, ?Closure $options = null): ComposerInterface
    {
        $command = (new UpdateCommand())
            ->withParameters($package)
            ->withOptions($options);
        tap($this->run($command), fn(Log $log) => $this->analyser->check($log));
        return $this;
    }

    /**
     * @param string $package
     * @param string|null $version
     * @param Closure|null $options
     * @return $this
     */
    public function require(string $package, ?string $version = null, ?Closure $options = null): ComposerInterface
    {
        $command = (new RequireCommand())
            ->withParameters(trim("{$package}:{$version}", ':'))
            ->withOptions($options);
        tap($this->run($command), fn(Log $log) => $this->analyser->check($log));
        return $this;
    }

    /**
     * @param string $package
     * @param Closure|null $options
     * @return $this
     */
    public function remove(string $package, ?Closure $options = null): ComposerInterface
    {
        $command = (new RemoveCommand())
            ->withParameters($package)
            ->withOptions($options);
        tap($this->run($command), fn(Log $log) => $this->analyser->check($log));
        return $this;
    }

    /**
     * @return PlatformRequirements
     */
    public function checkPlatformReqs(): PlatformRequirements
    {
        return new PlatformRequirements(tap(
            $this->run(new CheckPlatformReqsCommand()),
            fn(Log $log) => $this->analyser->check($log)
        )
        ->outputCollector());
    }

    /**
     * @param string $package
     * @return $this
     */
    public function createProject(string $package): ComposerInterface
    {
        $this->run((new CreateProjectCommand())->withParameters($package));
        return $this;
    }

    /**
     * @param string|null $filter
     * @param Closure|null $options
     * @return Packages
     */
    public function show(string $filter = null, ?Closure $options = null): Packages
    {
        assert(
            is_null($filter) || str_contains($filter, '*'),
            new AssertionError("Filter:'{$filter}' need wildcards")
        );
        $command = (new ShowCommand())
            ->withParameters($filter)
            ->withOptions($options)
            ->withOptions(fn(ShowOptionBag $optionBag) => $optionBag->format('json'));
        return new Packages((object)tap(
            $this->run($command),
            fn(Log $log) => $this->analyser->check($log)
        )->extractFirstJson());
    }

    /**
     * @param string $package
     * @param string|null $version
     * @return Package
     */
    public function showPackage(string $package, ?string $version = null): Package
    {
        assert(
            !str_contains($package, '*'),
            new AssertionError("Filter not supported")
        );
        $command = (new ShowCommand())
            ->withParameters($package, $version)
            ->withOptions(fn(ShowOptionBag $optionBag) => $optionBag->format('json'));
        return new Package(tap(
            $this->run($command),
            fn(Log $log) => $this->analyser->check($log)
        )->extractFirstJson());
    }

    /**
     * @param string|null $command
     * @return Help
     */
    public function help(?string $command = null): Help
    {
        $command = (new HelpCommand())
            ->withParameters($command)
            ->withOptions(fn(HelpOptionBag $optionBag) => $optionBag->format('json'));
        return new Help(tap(
            $this->run($command),
            fn(Log $log) => $this->analyser->check($log)
        )->extractFirstJson());
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        return tap(
            $this->run(new ValidateCommand()),
            fn(Log $log) => $this->analyser->check($log)
        )
        ->contains('composer.json is valid');
    }

    /**
     * @param CommandInterface $command
     * @return Log
     */
    public function run(CommandInterface $command): Log
    {
        return tap(new Log($this->logger), function (Log $log) use ($command) {
            $fullCommand = collect([...$command->toArray(), '-vv'])->unique();
            $log->info("\n=========================================================================\n");
            $log->info("/> Running: {$fullCommand->implode(' ')}\n");
            $this->executor->run(
                $fullCommand->toArray(),
                $this->environment->toArray(),
                fn ($type, $message) => $log->logOutput($type, $message)
            );
            $log->info("\> Finished:[{$this->executor->getExitCode()}]: {$this->executor->getCommandLine()}.\n");
            $log->info("   Duration: " . ($this->executor->getEndTime() - $this->executor->getStartTime()) . " sec.\n");
            $log->info("=========================================================================\n");
            $log->setExitCode($this->executor->getExitCode());
            $this->history->add($log);
        });
    }

    /**
     * @return Collection
     */
    public function history(): Collection
    {
        return $this->history;
    }
}
