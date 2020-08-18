<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Contracts;

use Closure;
use VDauchy\ComposerWrapper\Entities\Help;
use VDauchy\ComposerWrapper\Entities\Package;
use VDauchy\ComposerWrapper\Entities\Packages;
use VDauchy\ComposerWrapper\Entities\PlatformRequirements;

interface ComposerInterface
{
    /**
     * @param Closure|null $options
     * @return $this
     */
    public function init(?Closure $options = null): ComposerInterface;

    /**
     * @param Closure|null $options
     * @return $this
     */
    public function install(?Closure $options = null): ComposerInterface;

    /**
     * @param string|null $package
     * @param Closure|null $options
     * @return $this
     */
    public function update(?string $package = null, ?Closure $options = null): ComposerInterface;

    /**
     * @param string $package
     * @param string|null $version
     * @param Closure|null $options
     * @return $this
     */
    public function require(string $package, ?string $version = null, ?Closure $options = null): ComposerInterface;

    /**
     * @param string $package
     * @param Closure|null $options
     * @return ComposerInterface
     */
    public function remove(string $package, ?Closure $options = null): ComposerInterface;

    /**
     * @return PlatformRequirements
     */
    public function checkPlatformReqs(): PlatformRequirements;

    /**
     * @param string $package
     * @return $this
     */
    public function createProject(string $package): ComposerInterface;

    /**
     * @param string|null $filter
     * @param Closure|null $options
     * @return Packages
     */
    public function show(string $filter = null, ?Closure $options = null): Packages;

    /**
     * @param string $package
     * @param string|null $version
     * @return Package
     */
    public function showPackage(string $package, ?string $version = null): Package;

    /**
     * @param string|null $command
     * @return Help
     */
    public function help(?string $command = null): Help;
}
