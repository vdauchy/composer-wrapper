<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections\Abstracts;

use Illuminate\Support\Collection;
use VDauchy\ComposerWrapper\Contracts\SectionInterface;

abstract class ListSections implements SectionInterface
{
    private ?Collection $list;

    /**
     * @param array|null $list
     */
    public function __construct(?array $list)
    {
        $this->list = is_null($list) ? null : collect($list)->values();
    }

    /**
     * @param string|array $value
     * @return $this
     */
    public function append($value): ListSections
    {
        $this->list = collect($this->list)->reject($value)->add($value);
        return $this;
    }

    /**
     * @param string|array $value
     * @return $this
     */
    public function prepend($value): ListSections
    {
        $this->list = collect($this->list)->reject($value)->prepend($value);
        return $this;
    }

    /**
     * @param string|array $value
     * @return $this
     */
    public function remove($value): ListSections
    {
        $this->list = collect($this->list)->reject($value);
        return $this;
    }

    /**
     * @param string|array $value
     * @return bool
     */
    public function has($value): bool
    {
        return collect($this->list)->contains($value);
    }

    /**
     * @return Collection|null
     */
    public function get(): ?Collection
    {
        return $this->list;
    }

    /**
     * @param Collection|null $list
     * @return $this
     */
    public function put(?Collection $list = null): ListSections
    {
        $this->list = $list;
        return $this;
    }

    /**
     * @return array|null
     */
    public function value(): ?array
    {
        return is_null($this->list) ? null : $this->list->filter()->unique()->values()->toArray();
    }
}
