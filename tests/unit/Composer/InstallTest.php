<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Project;

use VDauchy\ComposerWrapper\Commands\OptionBag\InstallOptionBag;
use VDauchy\ComposerWrapper\Commands\OptionBag\RequireOptionBag;
use VDauchy\ComposerWrapper\Project;
use VDauchy\ComposerWrapper\Exceptions\JsonNotFoundException;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class InstallTest extends TestCase
{
    public function testInstallWithoutComposerJson()
    {
        $this->expectException(JsonNotFoundException::class);
        $this->createCachedProject()->composer()->install();
    }

    public function testInstallAfterInitAfterRequire()
    {
        $project = $this->createCachedProject();

        $this->assertFalse($project->hasJson());
        $this->assertFalse($project->hasLock());

        $project
            ->composer()
            ->init()
            ->require('psr/log')
            ->install();

        $this->assertTrue($project->hasJson());
        $this->assertTrue($project->hasLock());
        $this->assertTrue($project->composer()->show()->installed()->has('psr/log'));
    }

    public function testInstallAfterInitAfterRequireDevWithNoDev()
    {
        $project = $this->createCachedProject();

        $this->assertFalse($project->hasJson());
        $this->assertFalse($project->hasLock());

        $project
            ->composer()
            ->init()
            ->require('psr/log', null, fn(RequireOptionBag $optionBag) => $optionBag->dev())
            ->install(fn(InstallOptionBag $optionBag) => $optionBag->noDev());

        $this->assertTrue($project->hasJson());
        $this->assertTrue($project->getJson()->requireDev->has('psr/log'));
        $this->assertTrue($project->hasLock());
        $this->assertTrue($project->composer()->show()->installed()->isEmpty());
    }
}
