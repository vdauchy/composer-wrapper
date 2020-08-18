<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\OptionBag;

use VDauchy\ComposerWrapper\Commands\Abstracts\OptionBag;

/**
 * @method $this ansi()
 * @method $this author()
 * @method $this description()
 * @method $this help()
 * @method $this homepage()
 * @method $this license()
 * @method $this name()
 * @method $this noAnsi()
 * @method $this noCache()
 * @method $this noInteraction()
 * @method $this noPlugins()
 * @method $this profile()
 * @method $this quiet()
 * @method $this repository()
 * @method $this require()
 * @method $this requireDev()
 * @method $this stability()
 * @method $this type()
 * @method $this verbose()
 * @method $this version()
 * @method $this workingDir()
 */
class InitOptionBag extends OptionBag
{
    public const OPTIONS = [
        'ansi',
        'author',
        'description',
        'help',
        'homepage',
        'license',
        'name',
        'no-ansi',
        'no-cache',
        'no-interaction',
        'no-plugins',
        'profile',
        'quiet',
        'repository',
        'require',
        'require-dev',
        'stability',
        'type',
        'verbose',
        'version',
        'working-dir',
    ];
}
