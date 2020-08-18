<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\OptionBag;

use VDauchy\ComposerWrapper\Commands\Abstracts\OptionBag;

/**
 * @method $this ansi()
 * @method $this apcuAutoloader()
 * @method $this classmapAuthoritative()
 * @method $this dev()
 * @method $this fixed()
 * @method $this help()
 * @method $this ignorePlatformReqs()
 * @method $this noAnsi()
 * @method $this noCache()
 * @method $this noInteraction()
 * @method $this noPlugins()
 * @method $this noProgress()
 * @method $this noScripts()
 * @method $this noSuggest()
 * @method $this noUpdate()
 * @method $this optimizeAutoloader()
 * @method $this preferDist()
 * @method $this preferLowest()
 * @method $this preferSource()
 * @method $this preferStable()
 * @method $this profile()
 * @method $this quiet()
 * @method $this sortPackages()
 * @method $this updateNoDev()
 * @method $this updateWithAllDependencies()
 * @method $this updateWithDependencies()
 * @method $this verbose()
 * @method $this version()
 * @method $this workingDir()
 */

class RequireOptionBag extends OptionBag
{
    public const OPTIONS = [
        'ansi',
        'apcu-autoloader',
        'classmap-authoritative',
        'dev',
        'fixed',
        'help',
        'ignore-platform-reqs',
        'no-ansi',
        'no-cache',
        'no-interaction',
        'no-plugins',
        'no-progress',
        'no-scripts',
        'no-suggest',
        'no-update',
        'optimize-autoloader',
        'prefer-dist',
        'prefer-lowest',
        'prefer-source',
        'prefer-stable',
        'profile',
        'quiet',
        'sort-packages',
        'update-no-dev',
        'update-with-all-dependencies',
        'update-with-dependencies',
        'verbose',
        'version',
        'working-dir',
    ];
}
