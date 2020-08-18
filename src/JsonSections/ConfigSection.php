<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\JsonSections;

use Closure;
use Illuminate\Support\Collection;
use VDauchy\ComposerWrapper\JsonSections\Abstracts\ParentSection;
use VDauchy\ComposerWrapper\JsonSections\ConfigSection\OptimizeAutoloader;
use VDauchy\ComposerWrapper\JsonSections\ConfigSection\PreferredInstall;
use VDauchy\ComposerWrapper\JsonSections\ConfigSection\SortPackages;

/**
 * @property OptimizeAutoloader $optimizeAutoloader
 * @property PreferredInstall $preferredInstall
 * @property SortPackages $sortPackages
 * @method $this optimizeAutoloader(Closure $optimizeAutoloader)
 * @method $this preferredInstall(Closure $preferredInstall)
 * @method $this sortPackages(Closure $sortPackages)
 */
class ConfigSection extends ParentSection
{
    public const OPTIMIZE_AUTOLOADER    = 'optimize-autoloader';
    public const PREFERRED_INSTALL      = 'preferred-install';
    public const SORT_PACKAGES          = 'sort-packages';

    /**
     * @return Collection
     */
    protected function sections(): Collection
    {
        return collect([
            static::OPTIMIZE_AUTOLOADER =>  OptimizeAutoloader::class,
            static::PREFERRED_INSTALL   =>  PreferredInstall::class,
            static::SORT_PACKAGES       =>  SortPackages::class,
        ]);
    }
}
