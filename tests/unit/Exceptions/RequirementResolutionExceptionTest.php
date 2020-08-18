<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Exceptions;

use VDauchy\ComposerWrapper\Commands\OptionBag\RequireOptionBag;
use VDauchy\ComposerWrapper\Exceptions\RequirementResolutionException;
use VDauchy\ComposerWrapper\Project;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class RequirementResolutionExceptionTest extends TestCase
{
    public function testUpdateAllPackages()
    {
        $project = $this->createCachedProject();
        $composer = $project
            ->composer()
            ->init()
            ->require('psr/log', '1.0')
            ->require('sebastian/diff', '1.0')
            ->require('psr/container', '1.0');
        $this->assertStringStartsWith('1.0', $composer->showPackage('psr/log')->versions()->first());
        $this->assertStringStartsWith('1.0', $composer->showPackage('sebastian/diff')->versions()->first());
        $this->assertStringStartsWith('1.0', $composer->showPackage('psr/container')->versions()->first());

        $composer->require('psr/log', '1.1.0', fn(RequireOptionBag $optionBag) => $optionBag->noUpdate());
        $composer->require('sebastian/diff', '2.0', fn(RequireOptionBag $optionBag) => $optionBag->noUpdate());
        $composer->require('psr/container', '2.0', fn(RequireOptionBag $optionBag) => $optionBag->noUpdate());

        $this->expectException(RequirementResolutionException::class);
        $composer->update('psr/log');
    }
}
