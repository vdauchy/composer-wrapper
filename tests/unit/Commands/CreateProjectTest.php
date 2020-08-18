<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Commands;

use VDauchy\ComposerWrapper\Commands\CreateProjectCommand;
use VDauchy\ComposerWrapper\Project;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class CreateProjectTest extends TestCase
{
    public function testHasAllOptions()
    {
        $command = new CreateProjectCommand();
        $help = $this->createCachedProject()->composer()->help($command->name());
        $this->assertSame(
            $command->options()->values()->sort()->values()->toArray(),
            $help->options()->pluck('name')->sort()->values()->toArray()
        );
    }

    public function testHasAllProperties()
    {
        $command = new CreateProjectCommand();
        $expectedMethods = $command->options()->keys()->map(fn(string $methodName) => "\$this {$methodName}(")->sort()->values();
        $this->assertHasMagicMethod($expectedMethods, $command->optionBag());
    }
}
