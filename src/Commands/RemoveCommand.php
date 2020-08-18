<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;
use VDauchy\ComposerWrapper\Commands\OptionBag\RemoveOptionBag;

/**
 * @see https://getcomposer.org/doc/03-cli.md#remove
 */
class RemoveCommand extends Command
{
    public const COMMAND_NAME = 'remove';
    public const OPTION_BAG_CLASS = RemoveOptionBag::class;
}
