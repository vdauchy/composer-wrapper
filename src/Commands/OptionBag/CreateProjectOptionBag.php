<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\OptionBag;

use VDauchy\ComposerWrapper\Commands\Abstracts\OptionBag;

/**
 * @method $this addRepository()
 * @method $this ansi()
 * @method $this dev()
 * @method $this help()
 * @method $this ignorePlatformReqs()
 * @method $this keepVcs()
 * @method $this noAnsi()
 * @method $this noCache()
 * @method $this noCustomInstallers()
 * @method $this noDev()
 * @method $this noInstall()
 * @method $this noInteraction()
 * @method $this noPlugins()
 * @method $this noProgress()
 * @method $this noScripts()
 * @method $this noSecureHttp()
 * @method $this preferDist()
 * @method $this preferSource()
 * @method $this profile()
 * @method $this quiet()
 * @method $this removeVcs()
 * @method $this repository()
 * @method $this repositoryUrl()
 * @method $this stability()
 * @method $this verbose()
 * @method $this version()
 * @method $this workingDir()
 */
class CreateProjectOptionBag extends OptionBag
{
    public const OPTIONS = [
        'add-repository',
        'ansi',
        'dev',
        'help',
        'ignore-platform-reqs',
        'keep-vcs',
        'no-ansi',
        'no-cache',
        'no-custom-installers',
        'no-dev',
        'no-install',
        'no-interaction',
        'no-plugins',
        'no-progress',
        'no-scripts',
        'no-secure-http',
        'prefer-dist',
        'prefer-source',
        'profile',
        'quiet',
        'remove-vcs',
        'repository',
        'repository-url',
        'stability',
        'verbose',
        'version',
        'working-dir',
    ];
}
