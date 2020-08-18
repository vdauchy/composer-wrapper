<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands\OptionBag;

use VDauchy\ComposerWrapper\Commands\Abstracts\OptionBag;

/**
 * @method $this ansi()
 * @method $this help()
 * @method $this noAnsi()
 * @method $this noCache()
 * @method $this noCheckAll()
 * @method $this noCheckLock()
 * @method $this noCheckPublish()
 * @method $this noInteraction()
 * @method $this noPlugins()
 * @method $this profile()
 * @method $this quiet()
 * @method $this strict()
 * @method $this verbose()
 * @method $this version()
 * @method $this withDependencies()
 * @method $this workingDir()
 */
class ValidateOptionBag extends OptionBag
{
    public const OPTIONS = [
        'ansi',
        'help',
        'no-ansi',
        'no-cache',
        'no-check-all',
        'no-check-lock',
        'no-check-publish',
        'no-interaction',
        'no-plugins',
        'profile',
        'quiet',
        'strict',
        'verbose',
        'version',
        'with-dependencies',
        'working-dir',
    ];
}
