<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;
use VDauchy\ComposerWrapper\Commands\OptionBag\InitOptionBag;

/**
 * @see https://getcomposer.org/doc/03-cli.md#init
 */
class InitCommand extends Command
{
    public const COMMAND_NAME = 'init';
    public const OPTION_BAG_CLASS = InitOptionBag::class;
}
