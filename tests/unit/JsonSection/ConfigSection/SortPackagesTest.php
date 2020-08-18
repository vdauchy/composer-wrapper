<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\JsonSection\AutoloadSection;

use VDauchy\ComposerWrapper\JsonSections\ConfigSection\OptimizeAutoloader;
use VDauchy\ComposerWrapper\JsonSections\ConfigSection\SortPackages;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class SortPackagesTest extends TestCase
{
    public function testConstructNull()
    {
        $sortPackages = new SortPackages(null);
        $this->assertNull($sortPackages->value());
    }

    public function testPutTrue()
    {
        $sortPackages = new SortPackages(null);
        $sortPackages->put(true);
        $this->assertTrue($sortPackages->value());
    }

    public function testPutFalse()
    {
        $sortPackages = new SortPackages(null);
        $sortPackages->put(false);
        $this->assertFalse($sortPackages->value());
    }

    public function testPutNull()
    {
        $sortPackages = new SortPackages(true);
        $sortPackages->put();
        $this->assertNull($sortPackages->value());
    }
}
