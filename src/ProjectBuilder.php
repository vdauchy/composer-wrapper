<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper;

use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\Local\LocalFilesystemAdapter;
use VDauchy\ComposerWrapper\Contracts\AnalyserInterface;
use VDauchy\ComposerWrapper\Contracts\RunnerInterface;
use VDauchy\ComposerWrapper\Runners\LocalBinRunner;

class ProjectBuilder
{
    /**
     * @var string
     */
    protected string $workDir;

    /**
     * @var LocalBinRunner
     */
    protected LocalBinRunner $runner;

    /**
     * @var Filesystem
     */
    protected Filesystem $filesystem;

    /**
     * Builder constructor.
     * @param string $workDir
     */
    public function __construct(string $workDir)
    {
        $this->workDir = $workDir;
        $this->useLocalBinaryComposer();
    }

    /**
     * @return $this
     */
    public function useLocalBinaryComposer(): ProjectBuilder
    {
        $this->filesystem = new Filesystem(new LocalFilesystemAdapter($this->workDir));
        $this->runner = new LocalBinRunner($this->workDir);
        return $this;
    }

    /**
     * @param FilesystemOperator|null $fileSystem
     * @param RunnerInterface|null $runner
     * @param AnalyserInterface|null $analyser
     * @param Environment|null $environment
     * @return Project
     */
    public function build(
        ?FilesystemOperator $fileSystem = null,
        ?RunnerInterface $runner = null,
        ?AnalyserInterface $analyser = null,
        ?Environment $environment = null
    ): Project {
        return new Project(
            $fileSystem ?? $this->filesystem,
            new Composer(
                $runner ?? $this->runner,
                $analyser ?? new Analyser(),
                $environment ?? new Environment()
            )
        );
    }
}
