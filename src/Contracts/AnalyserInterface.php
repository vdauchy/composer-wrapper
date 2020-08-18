<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Contracts;

use VDauchy\ComposerWrapper\Log;

interface AnalyserInterface
{
    /**
     * @param Log $log
     */
    public function check(Log $log): void;
}
