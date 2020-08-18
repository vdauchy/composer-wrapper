<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

interface OptionBagInterface extends Arrayable
{
    /**
     * @return Collection
     */
    public function options(): Collection;

    /**
     * Get the instance as an array.
     * @return array
     */
    public function toArray(): array;
}
