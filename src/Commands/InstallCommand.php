<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;
use VDauchy\ComposerWrapper\Commands\OptionBag\InstallOptionBag;

/**
 * @see https://getcomposer.org/doc/03-cli.md#install-i
 */
class InstallCommand extends Command
{
    public const COMMAND_NAME = 'install';
    public const OPTION_BAG_CLASS = InstallOptionBag::class;
}
