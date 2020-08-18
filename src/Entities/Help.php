<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Entities;

use Illuminate\Support\Collection;

class Help
{
    private object $help;

    /**
     * @param object $help
     */
    public function __construct(object $help)
    {
        $this->help = $help;
    }

    /**
     * @return Collection
     */
    public function options(): Collection
    {
        return collect($this->help->definition->options);
    }

    /**
     * @return Collection
     */
    public function definition(): Collection
    {
        return collect($this->help->definition);
    }
}
