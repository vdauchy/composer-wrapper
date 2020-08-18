<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\Abstracts;

use Closure;
use Illuminate\Support\Collection;
use VDauchy\ComposerWrapper\Commands\OptionBag\NoOptionBag;
use VDauchy\ComposerWrapper\Contracts\CommandInterface;
use VDauchy\ComposerWrapper\Contracts\OptionBagInterface;

abstract class Command implements CommandInterface
{
    public const COMMAND_NAME = 'REPLACE_ME';
    public const OPTION_BAG_CLASS = null;

    /**
     * @var array
     */
    protected array $parameters = [];

    /**
     * @var OptionBagInterface
     */
    protected OptionBagInterface $optionBag;

    /**
     * @param string|null $optionBagClass
     */
    public function __construct(?string $optionBagClass = null)
    {
        $optionBagClass ??= static::OPTION_BAG_CLASS ?? NoOptionBag::class;
        $this->optionBag = new $optionBagClass();
    }

    /**
     * @param string|null ...$parameters
     * @return $this
     * @suppress PhanParamSignatureMismatch
     */
    public function withParameters(?string ...$parameters): CommandInterface
    {
        $this->parameters = array_filter($parameters);
        return $this;
    }

    /**
     * @param Closure|null $options
     * @return $this
     */
    public function withOptions(?Closure $options): CommandInterface
    {
        if ($options) {
            $options($this->optionBag);
        }
        return $this;
    }

    /**
     * @return string
     */
    final public function name(): string
    {
        return static::COMMAND_NAME;
    }

    /**
     * @return Collection
     */
    final public function options(): Collection
    {
        return $this->optionBag->options();
    }

    /**
     * @return OptionBagInterface
     */
    final public function optionBag(): OptionBagInterface
    {
        return $this->optionBag;
    }

    /**
     * @return array
     */
    final public function toArray(): array
    {
        return [$this->name(), ...$this->parameters, ...$this->optionBag->toArray()];
    }
}
