<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections\Abstracts;

use VDauchy\ComposerWrapper\Contracts\SectionValueInterface;

abstract class BoolSection implements SectionValueInterface
{
    private ?bool $value;

    /**
     * NameSection constructor.
     * @param bool|null $value
     */
    public function __construct(?bool $value)
    {
        $this->value = $value;
    }

    /**
     * @return bool|null
     */
    public function get(): ?bool
    {
        return $this->value;
    }

    /**
     * @param bool|null $value
     * @return $this
     */
    public function put(?bool $value = null): SectionValueInterface
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function value(): ?bool
    {
        return $this->value;
    }
}
