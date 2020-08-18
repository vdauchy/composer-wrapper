<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;
use VDauchy\ComposerWrapper\Commands\OptionBag\HelpOptionBag;

/**
 */
class HelpCommand extends Command
{
    public const COMMAND_NAME = 'help';
    public const OPTION_BAG_CLASS = HelpOptionBag::class;
}
