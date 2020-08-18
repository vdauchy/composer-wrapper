<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections;

use Closure;
use Illuminate\Support\Collection;
use VDauchy\ComposerWrapper\JsonSections\Abstracts\ParentSection;
use VDauchy\ComposerWrapper\JsonSections\AutoloadSection\ExcludeFromClassmapSection;
use VDauchy\ComposerWrapper\JsonSections\AutoloadSection\Psr4Section;

/**
 * @method $this psr4(Closure $psr4)
 * @method $this excludeFromClassmap(Closure $excludeFromClassmap)
 */
class AutoloadSection extends ParentSection
{
    public const PSR_4                  = 'psr-4';
    public const EXCLUDE_FROM_CLASSMAP  = 'exclude-from-classmap';

    /**
     * @return Collection
     */
    protected function sections(): Collection
    {
        return collect([
            static::PSR_4                   =>  Psr4Section::class,
            static::EXCLUDE_FROM_CLASSMAP   =>  ExcludeFromClassmapSection::class,
        ]);
    }
}
