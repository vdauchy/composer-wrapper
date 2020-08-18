<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Exceptions;

use VDauchy\ComposerWrapper\Exceptions\LogicException;
use VDauchy\ComposerWrapper\Project;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class LogicExceptionTest extends TestCase
{
    public function testUpdateAllPackages()
    {
        $this->expectException(LogicException::class);
        $project = $this->createCachedProject();
        $composer = $project->composer()->init();
        $composer->checkPlatformReqs();
    }
}
