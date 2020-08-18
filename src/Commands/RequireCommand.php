<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;
use VDauchy\ComposerWrapper\Commands\OptionBag\RequireOptionBag;

/**
 * @see https://getcomposer.org/doc/03-cli.md#require
 */
class RequireCommand extends Command
{
    public const COMMAND_NAME = 'require';
    public const OPTION_BAG_CLASS = RequireOptionBag::class;
}
