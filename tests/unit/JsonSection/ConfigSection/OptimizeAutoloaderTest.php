<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\JsonSection\AutoloadSection;

use VDauchy\ComposerWrapper\JsonSections\ConfigSection\OptimizeAutoloader;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class OptimizeAutoloaderTest extends TestCase
{
    public function testConstructNull()
    {
        $optimizeAutoloader = new OptimizeAutoloader(null);
        $this->assertNull($optimizeAutoloader->value());
    }

    public function testSetTrue()
    {
        $optimizeAutoloader = new OptimizeAutoloader(null);
        $optimizeAutoloader->put(true);
        $this->assertTrue($optimizeAutoloader->value());
    }

    public function testPutFalse()
    {
        $optimizeAutoloader = new OptimizeAutoloader(null);
        $optimizeAutoloader->put(false);
        $this->assertFalse($optimizeAutoloader->value());
    }

    public function testPutNull()
    {
        $optimizeAutoloader = new OptimizeAutoloader(true);
        $optimizeAutoloader->put();
        $this->assertNull($optimizeAutoloader->value());
    }
}
