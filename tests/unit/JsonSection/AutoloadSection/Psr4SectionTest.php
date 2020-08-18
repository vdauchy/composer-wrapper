<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\JsonSection\AutoloadSection;

use VDauchy\ComposerWrapper\Json;
use VDauchy\ComposerWrapper\JsonSections\AutoloadSection\Psr4Section;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class Psr4SectionTest extends TestCase
{
    public function testConstructNull()
    {
        $psr4Section = new Psr4Section(null, Json::buildFromContent());
        $this->assertNull($psr4Section->value());
    }

    public function testPutNull()
    {
        $psr4Section = new Psr4Section(['x' => 1, 'y' => 2, 'z' => 3], Json::buildFromContent());
        $psr4Section->put();
        $this->assertNull($psr4Section->value());
    }

    public function testPutAssoc()
    {
        $psr4Section = new Psr4Section(null, Json::buildFromContent());
        $psr4Section->put(collect(['x' => 1, 'y' => 2, 'z' => 3]));
        $this->assertEquals(['x' => 1, 'y' => 2, 'z' => 3], $psr4Section->value());
    }
}
