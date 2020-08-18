<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper;

use VDauchy\ComposerWrapper\Contracts\AnalyserInterface;
use VDauchy\ComposerWrapper\Exceptions\InvalidArgumentException;
use VDauchy\ComposerWrapper\Exceptions\JsonNotFoundException;
use VDauchy\ComposerWrapper\Exceptions\JsonValidationException;
use VDauchy\ComposerWrapper\Exceptions\LogicException;
use VDauchy\ComposerWrapper\Exceptions\RequirementResolutionException;
use VDauchy\ComposerWrapper\Exceptions\RuntimeException;
use VDauchy\ComposerWrapper\Exceptions\UnknownErrorException;

class Analyser implements AnalyserInterface
{
    public const LOGIC_EXCEPTION = '[LogicException]';
    public const JSON_VALIDATION_EXCEPTION = '[Composer\Json\JsonValidationException]';
    public const RUNTIME_EXCEPTION = '[Symfony\Component\Console\Exception\RuntimeException]';

    public const REQUIREMENT_ERROR = 'requirements could not be resolved';
    public const INVALID_ARGUMENTS = 'Invalid argument';
    public const MISSING_COMPOSER_JSON = 'could not find a composer.json';

    /**
     * @param Log $log
     * @throws InvalidArgumentException
     * @throws JsonNotFoundException
     * @throws JsonValidationException
     * @throws LogicException
     * @throws RequirementResolutionException
     * @throws RuntimeException
     * @throws UnknownErrorException
     */
    public function check(Log $log): void
    {
        if (! $log->failed()) {
            return;
        }
        if ($log->contains(static::INVALID_ARGUMENTS)) {
            throw new InvalidArgumentException($log->extractFrom(static::INVALID_ARGUMENTS));
        }
        if ($log->contains(static::MISSING_COMPOSER_JSON)) {
            throw new JsonNotFoundException();
        }
        if ($log->contains(static::REQUIREMENT_ERROR)) {
            throw new RequirementResolutionException(
                implode("\n", $log->extractProblems())
            );
        }
        if ($log->contains(static::LOGIC_EXCEPTION)) {
            throw new LogicException(
                $log->extractFrom(static::LOGIC_EXCEPTION, 1, 1)
            );
        }
        if ($log->contains(static::JSON_VALIDATION_EXCEPTION)) {
            throw new JsonValidationException(
                $log->extractFrom(static::JSON_VALIDATION_EXCEPTION, 2, 1)
            );
        }
        if ($log->contains(static::RUNTIME_EXCEPTION)) {
            throw new RuntimeException(
                $log->extractFrom(static::RUNTIME_EXCEPTION, 1, 1)
            );
        }
        throw new UnknownErrorException($log->loggerCollector()->implode(''));
    }
}
