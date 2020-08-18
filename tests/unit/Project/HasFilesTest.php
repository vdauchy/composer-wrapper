<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Project;

use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class HasFilesTest extends TestCase
{
    public function testHasJson()
    {
        $composerProject = $this->createCachedProject();
        $this->assertFalse($composerProject->hasJson());
    }

    public function testHasLock()
    {
        $composerProject = $this->createCachedProject();
        $this->assertFalse($composerProject->hasLock());
    }
}
