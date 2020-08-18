<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Commands;

use VDauchy\ComposerWrapper\Commands\ShowCommand;
use VDauchy\ComposerWrapper\Project;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class ShowTest extends TestCase
{
    public function testHasAllOptions()
    {
        $command = new ShowCommand();
        $help = $this->createCachedProject()->composer()->help($command->name());
        $this->assertSame(
            $command->options()->values()->sort()->values()->toArray(),
            $help->options()->pluck('name')->sort()->values()->toArray()
        );
    }

    public function testHasAllProperties()
    {
        $command = new ShowCommand();
        $expectedMethods = $command->options()->keys()->map(fn(string $methodName) => "\$this {$methodName}(")->sort()->values();
        $this->assertHasMagicMethod($expectedMethods, $command->optionBag());
    }
}
