<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper\Commands;

use VDauchy\ComposerWrapper\Commands\Abstracts\Command;

/**
 * @see https://getcomposer.org/doc/03-cli.md#check-platform-reqs
 */
class CheckPlatformReqsCommand extends Command
{
    public const COMMAND_NAME = 'check-platform-reqs';
}
