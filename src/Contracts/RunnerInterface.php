<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Contracts;

interface RunnerInterface
{
    /**
     * @param array $command
     * @param array $env
     * @param callable|null $callback
     */
    public function run(array $command, array $env = [], callable $callback = null): void;

    /**
     * @return int|null
     */
    public function getExitCode(): ?int;

    /**
     * @return string|null
     */
    public function getCommandLine(): ?string;

    /**
     * @return float|null
     */
    public function getEndTime() : ?float;

    /**
     * @return float|null
     */
    public function getStartTime(): ?float;
}
