<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;
use VDauchy\ComposerWrapper\Commands\OptionBag\CreateProjectOptionBag;

class CreateProjectCommand extends Command
{
    public const COMMAND_NAME = 'create-project';
    public const OPTION_BAG_CLASS = CreateProjectOptionBag::class;
}
