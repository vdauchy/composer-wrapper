<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\OptionBag;

use VDauchy\ComposerWrapper\Commands\Abstracts\OptionBag;

/**
 * @method $this ansi()
 * @method $this apcuAutoloader()
 * @method $this classmapAuthoritative()
 * @method $this dev()
 * @method $this help()
 * @method $this ignorePlatformReqs()
 * @method $this noAnsi()
 * @method $this noCache()
 * @method $this noInteraction()
 * @method $this noPlugins()
 * @method $this noProgress()
 * @method $this noScripts()
 * @method $this noUpdate()
 * @method $this noUpdateWithDependencies()
 * @method $this optimizeAutoloader()
 * @method $this profile()
 * @method $this quiet()
 * @method $this updateNoDev()
 * @method $this updateWithDependencies()
 * @method $this verbose()
 * @method $this version()
 * @method $this workingDir()
 */
class RemoveOptionBag extends OptionBag
{
    public const OPTIONS = [
        'ansi',
        'apcu-autoloader',
        'classmap-authoritative',
        'dev',
        'help',
        'ignore-platform-reqs',
        'no-ansi',
        'no-cache',
        'no-interaction',
        'no-plugins',
        'no-progress',
        'no-scripts',
        'no-update',
        'no-update-with-dependencies',
        'optimize-autoloader',
        'profile',
        'quiet',
        'update-no-dev',
        'update-with-dependencies',
        'verbose',
        'version',
        'working-dir',
    ];
}
