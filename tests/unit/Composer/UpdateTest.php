<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Project;

use VDauchy\ComposerWrapper\Commands\OptionBag\RequireOptionBag;
use VDauchy\ComposerWrapper\Project;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class UpdateTest extends TestCase
{
    public function testUpdateAllPackages()
    {
        $project = $this->createCachedProject();
        $composer = $project
            ->composer()
            ->init()
            ->require('psr/log', '1.0.0')
            ->require('sebastian/diff', '3.0.0');
        $this->assertSame('1.0.0', $composer->showPackage('psr/log')->versions()->first());
        $this->assertSame('3.0.0', $composer->showPackage('sebastian/diff')->versions()->first());

        $composer->require('psr/log', '1.1.0', fn(RequireOptionBag $optionBag) => $optionBag->noUpdate());
        $composer->require('sebastian/diff', '4.0', fn(RequireOptionBag $optionBag) => $optionBag->noUpdate());
        $this->assertStringStartsWith('1.0', $composer->showPackage('psr/log')->versions()->first());
        $this->assertStringStartsWith('3.0', $composer->showPackage('sebastian/diff')->versions()->first());

        $composer->update();
        $this->assertStringStartsWith('1.1', $composer->showPackage('psr/log')->versions()->first());
        $this->assertStringStartsWith('4.0', $composer->showPackage('sebastian/diff')->versions()->first());
    }

    public function testUpdateSpecificPackage()
    {
        $project = $this->createCachedProject();
        $composer = $project->composer()
            ->init()
            ->require('psr/log', '1.0')
            ->require('sebastian/diff', '1.0');
        $this->assertStringStartsWith('1.0', $composer->showPackage('psr/log')->versions()->first());
        $this->assertStringStartsWith('1.0', $composer->showPackage('sebastian/diff')->versions()->first());

        $composer->require('psr/log', '1.0|1.1', fn(RequireOptionBag $optionBag) => $optionBag->noUpdate());
        $composer->require('sebastian/diff', '1.0|1.1', fn(RequireOptionBag $optionBag) => $optionBag->noUpdate());
        $this->assertStringStartsWith('1.0', $composer->showPackage('psr/log')->versions()->first());
        $this->assertStringStartsWith('1.0', $composer->showPackage('sebastian/diff')->versions()->first());

        $composer->update('psr/log');
        $this->assertStringStartsWith('1.1', $composer->showPackage('psr/log')->versions()->first());
        $this->assertStringStartsWith('1.0', $composer->showPackage('sebastian/diff')->versions()->first());

        $composer->update('sebastian/diff');
        $this->assertStringStartsWith('1.1', $composer->showPackage('psr/log')->versions()->first());
        $this->assertStringStartsWith('1.1', $composer->showPackage('sebastian/diff')->versions()->first());
    }
}
