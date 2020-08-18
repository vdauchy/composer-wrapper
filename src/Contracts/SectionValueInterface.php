<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Contracts;

interface SectionValueInterface extends SectionInterface
{
    /**
     * @return mixed|null
     */
    public function get();

    /**
     * @return $this
     */
    public function put(): SectionValueInterface;
}
