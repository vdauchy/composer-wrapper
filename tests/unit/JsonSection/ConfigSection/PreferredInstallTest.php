<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\JsonSection\AutoloadSection;

use VDauchy\ComposerWrapper\Json;
use VDauchy\ComposerWrapper\JsonSections\ConfigSection\PreferredInstall;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class PreferredInstallTest extends TestCase
{
    public function testConstructNull()
    {
        $preferredInstall = new PreferredInstall(null, Json::buildFromContent());
        $this->assertNull($preferredInstall->value());
    }

    public function testPutNull()
    {
        $preferredInstall = new PreferredInstall(null, Json::buildFromContent());
        $preferredInstall->put();
        $this->assertEmpty($preferredInstall->value());
    }

    public function testPutAssoc()
    {
        $preferredInstall = new PreferredInstall(null, Json::buildFromContent());
        $preferredInstall->put(collect(['x' => 1, 'y' => 2, 'z' => 3]));
        $this->assertEquals(['x' => 1, 'y' => 2, 'z' => 3], $preferredInstall->value());
    }
}
