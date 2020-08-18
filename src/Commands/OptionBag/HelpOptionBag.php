<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\OptionBag;

use VDauchy\ComposerWrapper\Commands\Abstracts\OptionBag;

/**
 * @method $this format(string $format)
 * @method $this xml()
 * @method $this raw()
 * @method $this help()
 * @method $this quiet()
 * @method $this verbose()
 * @method $this version()
 * @method $this ansi()
 * @method $this noAnsi()
 * @method $this noInteraction()
 * @method $this profile()
 * @method $this noPlugins()
 * @method $this workingDir()
 * @method $this noCache()
 */
class HelpOptionBag extends OptionBag
{
    public const OPTIONS = [
        'format',
        'xml',
        'raw',
        'help',
        'quiet',
        'verbose',
        'version',
        'ansi',
        'no-ansi',
        'no-interaction',
        'profile',
        'no-plugins',
        'working-dir',
        'no-cache',
    ];
}
