<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Tests\Unit\Commands;

use VDauchy\ComposerWrapper\Commands\UpdateCommand;
use VDauchy\ComposerWrapper\Project;
use VDauchy\ComposerWrapper\Tests\Unit\TestCase;

class UpdateTest extends TestCase
{
    public function testHasAllOptions()
    {
        $command = new UpdateCommand();
        $help = $this->createCachedProject()->composer()->help($command->name());
        $this->assertSame(
            $command->options()->values()->sort()->values()->toArray(),
            $help->options()->pluck('name')->sort()->values()->toArray()
        );
    }

    public function testHasAllProperties()
    {
        $command = new UpdateCommand();
        $expectedMethods = $command->options()->keys()->map(fn(string $methodName) => "\$this {$methodName}(")->sort()->values();
        $this->assertHasMagicMethod($expectedMethods, $command->optionBag());
    }
}
