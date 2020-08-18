<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tag;
use phpDocumentor\Reflection\DocBlockFactory;
use ReflectionClass;
use VDauchy\ComposerWrapper\ProjectBuilder;
use VDauchy\ComposerWrapper\Environment;
use VDauchy\ComposerWrapper\Project;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected string $projectName;

    protected string $projectPath;

    /**
     *
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->projectName = $this->getName();
        $this->projectPath = $this->createProject($this->projectName);
    }

    /**
     *
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        if (! $this->hasFailed()) {
            $this->deleteProject($this->projectName);
        }
    }

    /**
     * @return Project
     */
    protected function createCachedProject(): Project
    {
        return tap(
            (new ProjectBuilder($this->projectPath))->build(),
            fn(Project $project) => $project
                ->composer()
            ->env(fn(Environment $environment) => $environment->cacheDir($this->cachePath()))
        );
    }

    /**
     * @return string
     */
    protected function dataPath(): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            __DIR__,
            '..',
            '__data'
        ]);
    }

    /**
     * @param string $projectName
     * @return string
     */
    protected function createProject(string $projectName)
    {
        $this->deleteProject($projectName);
        mkdir($projectPath = $this->projectPath($projectName), 777, true);
        return $projectPath;
    }

    /**
     * @param string $projectName
     * @return string
     */
    protected function deleteProject(string $projectName)
    {
        if (file_exists($projectPath = $this->projectPath($projectName))) {
            exec("rm -rf {$projectPath}");
        }
        return $projectPath;
    }

    /**
     * @param string $projectName
     * @return string
     */
    protected function projectPath(string $projectName): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            $this->dataPath(),
            'projects',
            $projectName,
        ]);
    }

    /**
     * @return string
     */
    protected function cachePath(): string
    {
        return implode(DIRECTORY_SEPARATOR, [
            $this->dataPath(),
            'cache',
        ]);
    }

    /**
     * @param Collection $expectedStartMethods
     * @param object $target
     */
    protected function assertHasMagicMethod(Collection $expectedStartMethods, object $target): void
    {
        $magicMethods = $this->extractMethodsFromComments($target);
        $expectedStartMethods->each(function (string $expectedStartMethod) use ($magicMethods, $target) {
            $this->assertNotNull(
                $magicMethods->first(fn(string $magicMethod) => Str::startsWith($magicMethod, trim($expectedStartMethod))),
                "Fail finding method starting by: '{$expectedStartMethod}' in Class:'" . get_class($target). "'."
            );
        });
    }

    /**
     * @param object $object
     * @return Collection
     */
    private function extractMethodsFromComments(object $object): Collection
    {
        $reflexion = new ReflectionClass($object);
        $docblock = DocBlockFactory::createInstance()->create($reflexion);
        return collect($docblock->getTags())
            ->filter(fn(Tag $tag) => $tag->getName() === 'method')
            ->map(fn(Tag $tag) => (string)$tag);
    }
}
