<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Entities;

use Illuminate\Support\Collection;

class Packages
{
    private object $packages;

    /**
     * @param object $packages
     */
    public function __construct(object $packages)
    {
        $this->packages = $packages;
    }

    /**
     * @return Collection
     * @suppress PhanUndeclaredFunctionInCallable
     */
    public function installed(): Collection
    {
        return collect($this->packages->installed ?? [])->keyBy('name');
    }
}
