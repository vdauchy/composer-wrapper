<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Contracts;

interface SectionInterface
{
    /**
     * @return string|array|null
     */
    public function value();
}
