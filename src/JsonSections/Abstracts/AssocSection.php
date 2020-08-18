<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections\Abstracts;

use Illuminate\Support\Collection;
use VDauchy\ComposerWrapper\Contracts\SectionInterface;
use VDauchy\ComposerWrapper\Json;

abstract class AssocSection implements SectionInterface
{
    protected ?Collection $assoc;

    protected Json $json;

    /**
     * @param array|null $assoc
     * @param Json $json
     */
    public function __construct(?array $assoc, Json $json)
    {
        $this->assoc = is_null($assoc) ? null : collect($assoc);
        $this->json = $json;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function remove(string $key): AssocSection
    {
        $this->assoc = collect($this->assoc)->forget($key);
        return $this;
    }

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function add(string $key, $value): AssocSection
    {
        $this->assoc = collect($this->assoc)->put($key, $value);
        return $this;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return collect($this->assoc)->has($key);
    }

    /**
     * @return Collection|null
     */
    public function get(): ?Collection
    {
        return $this->assoc;
    }

    /**
     * @param Collection|null $assoc
     * @return $this
     */
    public function put(?Collection $assoc = null): AssocSection
    {
        $this->assoc = $assoc;
        return $this;
    }

    /**
     * @return array|null
     */
    public function value(): ?array
    {
        return is_null($this->assoc) ? null : $this->assoc->filter()->sortKeys()->toArray();
    }
}
