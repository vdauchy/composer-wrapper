<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\JsonSection\AutoloadSection;

use VDauchy\ComposerWrapper\JsonSections\AutoloadSection\ExcludeFromClassmapSection;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class ExcludeFromClassmapSectionTest extends TestCase
{
    public function testConstructNull()
    {
        $excludeFromClassmapSection = new ExcludeFromClassmapSection(null);
        $this->assertNull($excludeFromClassmapSection->value());
    }

    public function testPutNull()
    {
        $excludeFromClassmapSection = new ExcludeFromClassmapSection(['a', 'b', 'c']);
        $excludeFromClassmapSection->put();
        $this->assertNull($excludeFromClassmapSection->value());
    }

    public function testPutAssoc()
    {
        $excludeFromClassmapSection = new ExcludeFromClassmapSection(null);
        $excludeFromClassmapSection->put(collect(['x' => 1, 'y' => 2, 'z' => 3]));
        $this->assertEquals([1, 2, 3], $excludeFromClassmapSection->value());
    }
}
