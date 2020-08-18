<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;
use VDauchy\ComposerWrapper\Commands\OptionBag\ShowOptionBag;

/**
 * @see https://getcomposer.org/doc/03-cli.md#show
 */
class ShowCommand extends Command
{
    public const COMMAND_NAME = 'show';
    public const OPTION_BAG_CLASS = ShowOptionBag::class;
}
