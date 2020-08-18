<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Runners;

use Psr\Log\LoggerInterface;
use Symfony\Component\Process\Process;
use VDauchy\ComposerWrapper\Contracts\RunnerInterface;

class LocalBinRunner implements RunnerInterface
{
    /**
     * @var string
     */
    private string $project;

    /**
     * @var LoggerInterface|null
     */
    private ?LoggerInterface $logger;

    /**
     * @var Process|null
     */
    private ?Process $lastProcess;

    /**
     * @param string $project
     * @param LoggerInterface|null $logger
     */
    public function __construct(string $project, ?LoggerInterface $logger = null)
    {
        $this->project = $project;
        $this->logger = $logger;
        $this->lastProcess = null;
    }

    /**
     * @param array $command
     * @param array $env
     * @param callable|null $callback
     * @return void
     */
    public function run(array $command, array $env = [], callable $callback = null): void
    {
        $this->lastProcess = tap(
            (new Process(['composer', ...$command], $this->project))->setTimeout(600),
            fn(Process $process) => $process->run($callback, $env)
        );
    }

    /**
     * @return int|null
     */
    public function getExitCode(): ?int
    {
        return $this->lastProcess ? $this->lastProcess->getExitCode() : null;
    }

    /**
     * @return string|null
     */
    public function getCommandLine(): ?string
    {
        return $this->lastProcess ? $this->lastProcess->getCommandLine() : null;
    }

    /**
     * @return float|null
     */
    public function getEndTime(): ?float
    {
        return $this->lastProcess ? $this->lastProcess->getLastOutputTime() : null;
    }

    /**
     * @return float|null
     */
    public function getStartTime(): ?float
    {
        return $this->lastProcess ? $this->lastProcess->getStartTime() : null;
    }
}
