<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;
use VDauchy\ComposerWrapper\Commands\OptionBag\UpdateOptionBag;

/**
 * @see https://getcomposer.org/doc/03-cli.md#update
 */
class UpdateCommand extends Command
{
    public const COMMAND_NAME = 'update';
    public const OPTION_BAG_CLASS = UpdateOptionBag::class;
}
