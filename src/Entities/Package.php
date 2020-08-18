<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Entities;

use Illuminate\Support\Collection;

class Package
{
    private object $package;

    /**
     * @param object $package
     */
    public function __construct(object $package)
    {
        $this->package = $package;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->package->name;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->package->description;
    }

    /**
     * @return Collection
     */
    public function keywords(): Collection
    {
        return collect($this->package->keywords);
    }

    /**
     * @return string
     */
    public function type(): string
    {
        return $this->package->description;
    }

    /**
     * @return string
     */
    public function homepage(): string
    {
        return $this->package->homepage;
    }

    /**
     * @return Collection
     */
    public function names(): Collection
    {
        return collect($this->package->names);
    }

    /**
     * @return Collection
     */
    public function versions(): Collection
    {
        return collect($this->package->versions);
    }

    /**
     * @return Collection
     */
    public function licenses(): Collection
    {
        return collect($this->package->licenses);
    }

    /**
     * @return Collection
     */
    public function source(): Collection
    {
        return collect($this->package->source);
    }

    /**
     * @return Collection
     */
    public function dist(): Collection
    {
        return collect($this->package->dist);
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return $this->package->path;
    }

    /**
     * @return Collection
     */
    public function autoload(): Collection
    {
        return collect($this->package->autoload);
    }

    /**
     * @return Collection
     */
    public function requires(): Collection
    {
        return collect($this->package->requires);
    }
}
