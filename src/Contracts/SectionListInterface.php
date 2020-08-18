<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Contracts;

interface SectionListInterface extends SectionInterface
{
    /**
     * @param string $content
     * @return $this
     */
    public function append(string $content): SectionListInterface;

    /**
     * @param string $content
     * @return $this
     */
    public function prepend(string $content): SectionListInterface;

    /**
     * @param string $content
     * @return $this
     */
    public function remove(string $content): SectionListInterface;

    /**
     * @return array|null
     */
    public function get(): ?array;

    /**
     * @param array|null $content
     * @return $this
     */
    public function put(?array $content): SectionListInterface;
}
