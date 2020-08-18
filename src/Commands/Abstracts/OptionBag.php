<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\Abstracts;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use VDauchy\ComposerWrapper\Contracts\OptionBagInterface;

abstract class OptionBag implements OptionBagInterface
{
    public const OPTIONS = [
    ];

    protected Collection $options;

    /**
     * OptionBagAbstract constructor.
     */
    public function __construct()
    {
        $this->options = collect();
    }

    /**
     * @return array
     */
    final public function toArray(): array
    {
        return $this
            ->options
            ->map(fn(array $arguments, string $option) => [$option, ...$arguments])
            ->values()
            ->flatten()
            ->toArray();
    }

    /**
     * @param string $name
     * @param string[] $arguments
     * @return OptionBag
     * @throws \Exception
     */
    final public function __call(string $name, array $arguments): self
    {
        if ($option = $this->options()->get($name)) {
            /* Use option as key to avoid duplicate */
            $this->options->put($option, $arguments);
            return $this;
        }
        throw new \Exception("Unknown Option method:{$name}");
    }

    /**
     * @return Collection
     */
    public function options(): Collection
    {
        return collect(static::OPTIONS)->mapWithKeys(fn(string $option) => [
            Str::camel($option) => Str::snake("--{$option}")
        ]);
    }
}
