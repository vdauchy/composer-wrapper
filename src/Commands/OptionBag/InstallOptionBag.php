<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\OptionBag;

use VDauchy\ComposerWrapper\Commands\Abstracts\OptionBag;

/**
 * @method $this ansi()
 * @method $this apcuAutoloader()
 * @method $this classmapAuthoritative()
 * @method $this dev()
 * @method $this dryRun()
 * @method $this help()
 * @method $this ignorePlatformReqs()
 * @method $this noAnsi()
 * @method $this noAutoloader()
 * @method $this noCache()
 * @method $this noCustomInstallers()
 * @method $this noDev()
 * @method $this noInteraction()
 * @method $this noPlugins()
 * @method $this noProgress()
 * @method $this noScripts()
 * @method $this noSuggest()
 * @method $this optimizeAutoloader()
 * @method $this preferDist()
 * @method $this preferSource()
 * @method $this profile()
 * @method $this quiet()
 * @method $this verbose()
 * @method $this version()
 * @method $this workingDir()
 * @see https://getcomposer.org/doc/03-cli.md#install-i
 */
class InstallOptionBag extends OptionBag
{
    public const OPTIONS = [
        'ansi',
        'apcu-autoloader',
        'classmap-authoritative',
        'dev',
        'dry-run',
        'help',
        'ignore-platform-reqs',
        'no-ansi',
        'no-autoloader',
        'no-cache',
        'no-custom-installers',
        'no-dev',
        'no-interaction',
        'no-plugins',
        'no-progress',
        'no-scripts',
        'no-suggest',
        'optimize-autoloader',
        'prefer-dist',
        'prefer-source',
        'profile',
        'quiet',
        'verbose',
        'version',
        'working-dir',
    ];
}
