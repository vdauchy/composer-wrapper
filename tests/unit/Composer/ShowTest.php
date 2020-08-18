<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Project;

use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class ShowTest extends TestCase
{
    public function testShowAfterInit()
    {
        $project = $this->createCachedProject();
        $composer = $project->composer()->init();
        $this->assertTrue($composer->show()->installed()->isEmpty());
    }

    public function testShow()
    {
        $project = $this->createCachedProject();
        $composer = $project
            ->composer()
            ->init()
            ->require('psr/log', '1.1.0')
            ->require('sebastian/diff')
            ->require('psr/container');

        $packages = $composer->show();
        $this->assertCount(3, $packages->installed());
        $this->assertTrue($packages->installed()->has('psr/log'));

        $packages = $composer->show('psr/*');
        $this->assertCount(2, $packages->installed());
        $this->assertTrue($packages->installed()->has('psr/log'));

        $package = $composer->showPackage('psr/log');
        $this->assertEquals('psr/log', $package->name());
        $this->assertEquals('1.1.0', $package->versions()->first());
    }
}
