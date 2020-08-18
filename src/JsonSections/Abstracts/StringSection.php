<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections\Abstracts;

use VDauchy\ComposerWrapper\Contracts\SectionValueInterface;

abstract class StringSection implements SectionValueInterface
{
    private ?string $value;

    /**
     * NameSection constructor.
     * @param string|null $value
     */
    public function __construct(?string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string|null
     */
    public function get(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     * @return $this
     */
    public function put(?string $value = null): SectionValueInterface
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return string|null
     */
    public function value(): ?string
    {
        return $this->value;
    }
}
