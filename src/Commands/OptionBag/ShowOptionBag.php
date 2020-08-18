<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\OptionBag;

use VDauchy\ComposerWrapper\Commands\Abstracts\OptionBag;

/**
 * @method $this all()
 * @method $this ansi()
 * @method $this available()
 * @method $this direct()
 * @method $this format(string $format)
 * @method $this help()
 * @method $this ignore()
 * @method $this installed()
 * @method $this latest()
 * @method $this minorOnly()
 * @method $this nameOnly()
 * @method $this noAnsi()
 * @method $this noCache()
 * @method $this noInteraction()
 * @method $this noPlugins()
 * @method $this outdated()
 * @method $this path()
 * @method $this platform()
 * @method $this profile()
 * @method $this quiet()
 * @method $this self()
 * @method $this strict()
 * @method $this tree()
 * @method $this verbose()
 * @method $this version()
 * @method $this workingDir()
 */
class ShowOptionBag extends OptionBag
{
    public const OPTIONS = [
        'all',
        'ansi',
        'available',
        'direct',
        'format',
        'help',
        'ignore',
        'installed',
        'latest',
        'minor-only',
        'name-only',
        'no-ansi',
        'no-cache',
        'no-interaction',
        'no-plugins',
        'outdated',
        'path',
        'platform',
        'profile',
        'quiet',
        'self',
        'strict',
        'tree',
        'verbose',
        'version',
        'working-dir',
    ];
}
