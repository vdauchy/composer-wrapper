<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections\Abstracts;

use Closure;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Throwable;
use VDauchy\ComposerWrapper\Contracts\SectionInterface;
use VDauchy\ComposerWrapper\Json;

abstract class ParentSection implements SectionInterface
{
    /**
     * @var Collection
     */
    protected Collection $structure;

    /**
     * @var Json
     */
    private Json $json;

    /**
     * @param array|null $structure
     * @param Json|null $parentJson
     * @suppress PhanPartialTypeMismatchProperty
     */
    public function __construct(?array $structure, ?Json $parentJson = null)
    {
        assert(
            $parentJson || $this instanceof Json,
            "Parent JSON must be set or current section must be a Json"
        );
        $this->structure = Collect($structure);
        $this->json = $parentJson ?? $this;
    }

    /**
     * @param string $name
     * @return SectionInterface
     */
    public function __get(string $name): SectionInterface
    {
        if (! $sectionClass = $this->methodToSectionClass($name)) {
            throw new Exception("Section Property:[{$name}] does not exist.");
        }
        try {
            return (new $sectionClass($this->structure->get($this->classToSectionName($sectionClass)), $this->json));
        } catch (Throwable $throwable) {
            throw new Exception("Instance creation of {$sectionClass} failed due to:{$throwable->getMessage()}");
        }
    }

    /**
     * @param string $name
     * @param SectionInterface $section
     * @throws Exception
     */
    public function __set(string $name, SectionInterface $section): void
    {
        if (! $sectionClass = $this->methodToSectionClass($name)) {
            throw new Exception("Section Method:[{$name}] does not exist.");
        }
        if (! $section instanceof $sectionClass) {
            throw new Exception("Value of type:{$sectionClass} expected.");
        }
        $this->structure->put($this->classToSectionName($sectionClass), $section->value());
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return ParentSection
     */
    public function __call(string $name, array $arguments): self
    {
        $closure = ($arguments[0] ?? null);
        if ($closure instanceof Closure) {
            $this->$name = $closure($this->$name);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function value(): array
    {
        return $this->structure->filter()->toArray();
    }

    /**
     * @param string $class
     * @return string|null
     */
    protected function classToSectionName(string $class): ?string
    {
        return $this->sections()->flip()->get($class);
    }

    /**
     * @param string $method
     * @return string|null
     */
    protected function methodToSectionClass(string $method): ?string
    {
        // @phan-suppress-next-line PhanUnusedPublicNoOverrideMethodParameter
        return $this->sections()->keyBy(fn($item, $key) => Str::camel($key))->get($method);
    }

    /**
     * @return Collection
     */
    abstract protected function sections(): Collection;
}
