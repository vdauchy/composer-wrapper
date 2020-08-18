<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper;

use Closure;
use League\Flysystem\FilesystemOperator;
use VDauchy\ComposerWrapper\Contracts\ComposerInterface;
use VDauchy\ComposerWrapper\Exceptions\JsonNotFoundException;

class Project
{
    public const COMPOSER_JSON = 'composer.json';
    public const COMPOSER_LOCK = 'composer.lock';

    /**
     * @var ComposerInterface
     */
    private ComposerInterface $composer;

    /**
     * @var FilesystemOperator
     */
    private FilesystemOperator $workDir;

    /**
     * @param FilesystemOperator $workDir
     * @param ComposerInterface $composer
     */
    public function __construct(FilesystemOperator $workDir, ComposerInterface $composer)
    {
        $this->composer = $composer;
        $this->workDir = $workDir;
    }

    /**
     * @return ComposerInterface
     */
    public function composer(): ComposerInterface
    {
        return $this->composer;
    }

    /**
     * @return bool
     */
    public function hasLock(): bool
    {
        return $this->workDir->fileExists($this->relativePath(static::COMPOSER_LOCK));
    }

    /**
     * @return bool
     */
    public function hasJson(): bool
    {
        return  $this->workDir->fileExists($this->relativePath(static::COMPOSER_JSON));
    }

    /**
     * @return Json
     */
    public function getJson(): Json
    {
        return Json::buildFromContent($this->workDir->read($this->relativePath(static::COMPOSER_JSON)));
    }

    /**
     * @param Json $composerJson
     * @return void
     */
    public function putJson(Json $composerJson): void
    {
        $this->workDir->write(
            $this->relativePath(static::COMPOSER_JSON),
            (string)json_encode($composerJson, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
        );
    }

    /**
     * @param Closure $closure
     * @return $this
     * @throws JsonNotFoundException
     */
    public function json(Closure $closure): self
    {
        if (! $this->hasJson()) {
            throw new JsonNotFoundException();
        }
        $this->putJson($closure($this->getJson()));
        return $this;
    }

    /**
     * @param string ...$files
     * @return string
     */
    protected function relativePath(string ...$files): string
    {
        return implode(DIRECTORY_SEPARATOR, $files);
    }
}
