<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;
use VDauchy\ComposerWrapper\Commands\OptionBag\ValidateOptionBag;

class ValidateCommand extends Command
{
    public const COMMAND_NAME = 'validate';
    public const OPTION_BAG_CLASS = ValidateOptionBag::class;
}
