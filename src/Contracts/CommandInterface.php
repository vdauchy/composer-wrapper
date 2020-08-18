<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Contracts;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

interface CommandInterface extends Arrayable
{
    /**
     * @param string|null ...$parameters
     * @return $this
     */
    public function withParameters(?string ...$parameters): CommandInterface;

    /**
     * @param Closure|null $options
     * @return $this
     */
    public function withOptions(?Closure $options): CommandInterface;

    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return Collection
     */
    public function options(): Collection;

    /**
     * @return OptionBagInterface
     */
    public function optionBag(): OptionBagInterface;
}
