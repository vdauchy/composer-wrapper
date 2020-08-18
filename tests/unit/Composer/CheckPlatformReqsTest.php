<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Project;

use VDauchy\ComposerWrapper\Project;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class CheckPlatformReqsTest extends TestCase
{
    public function testCheckPlatform()
    {
        $project = $this->createCachedProject()
            ->composer()
            ->init()
            ->require('psr/log');

        $platformRequirements = $project->checkPlatformReqs();

        $this->assertTrue($platformRequirements->has('php'));
        $this->assertSame('success', $platformRequirements->get('php')->state);
        $this->assertNotEmpty('success', $platformRequirements->get('php')->version);
    }
}
