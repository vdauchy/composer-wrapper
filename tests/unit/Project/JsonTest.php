<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Project;

use VDauchy\ComposerWrapper\Exceptions\JsonNotFoundException;
use VDauchy\ComposerWrapper\Json;
use VDauchy\ComposerWrapper\JsonSections\NameSection;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class JsonTest extends TestCase
{
    public function testUpdateMissingJsonWithName()
    {
        $this->expectException(JsonNotFoundException::class);
        $this->createCachedProject()->json(fn(Json $json) => $json);
    }

    public function testUpdateExistingJsonWithName()
    {
        $project = $this->createCachedProject();
        $project->composer()->init();

        $this->assertEmpty($project->getJson()->name->get());
        $project->json(fn(Json $json) => $json->name(fn(NameSection $nameSection) => $nameSection
            ->put('NewName')));
        $this->assertSame('NewName', $project->getJson()->name->get());
    }
}
