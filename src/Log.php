<?php
declare(strict_types=1);

namespace VDauchy\ComposerWrapper;

use Illuminate\Support\Collection;
use Psr\Log\LoggerInterface;
use VDauchy\ComposerWrapper\Exceptions\LogExtractionException;

class Log implements LoggerInterface
{
    /**
     * @var LoggerInterface|null
     */
    private ?LoggerInterface $logger;

    /**
     * @var string
     */
    private string $loggerCollector;

    /**
     * @var int|null
     */
    private ?int $exitCode;

    /**
     * @var string
     */
    private string $outputCollector;

    /**
     * @param LoggerInterface|null $logger
     */
    public function __construct(?LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->loggerCollector = '';
        $this->outputCollector = '';
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function emergency($message, array $context = []): void
    {
        $this->log('emergency', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function alert($message, array $context = []): void
    {
        $this->log('alert', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function critical($message, array $context = []): void
    {
        $this->log('critical', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function error($message, array $context = []): void
    {
        $this->log('error', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function warning($message, array $context = []): void
    {
        $this->log('warning', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function notice($message, array $context = []): void
    {
        $this->log('notice', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function info($message, array $context = []): void
    {
        $this->log('info', $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function debug($message, array $context = []): void
    {
        $this->log('debug', $message, $context);
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = []): void
    {
        assert(! isset($this->exitCode), "No log authorized after command exited.");
        $this->loggerCollector .= $message;
        if ($this->logger) {
            $this->logger->log($level, $message, $context);
        }
    }

    /**
     * @return LoggerInterface|null
     */
    public function logger(): ?LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @param string $type
     * @param string $message
     */
    public function logOutput(string $type, string $message): void
    {
        $this->log($type, $message);
        $this->outputCollector .= $message;
    }

    /**
     * @return Collection
     */
    public function outputCollector(): Collection
    {
        return collect(explode("\n", $this->outputCollector));
    }

    /**
     * @return Collection
     */
    public function loggerCollector(): Collection
    {
        return collect(explode("\n", $this->loggerCollector));
    }

    /**
     * @return bool
     */
    public function failed(): bool
    {
        return (bool)$this->exitCode;
    }

    /**
     * @param string $string
     * @return bool
     */
    public function contains(string $string): bool
    {
        return str_contains($this->outputCollector()->implode(''), $string);
    }

    /**
     * @param string $needle
     * @param int $offset
     * @param int|null $length
     * @return string
     */
    public function extractFrom(string $needle, int $offset = 0, ?int $length = null): string
    {
        foreach ($this->outputCollector() as $index => $line) {
            if (str_contains($line, $needle)) {
                return $this->outputCollector()
                    ->slice((int)($index + $offset), $length)
                    ->map(fn(string $line) => trim($line))
                    ->implode("\n");
            }
        }
        return '';
    }

    /**
     * @return array
     */
    public function extractProblems(): array
    {
        $problemStack = collect();
        while ($extracted = $this->extractFrom("Problem " . ($problemStack->count() + 1), 1, 1)) {
            $problemStack->add($extracted);
        }
        return $problemStack->toArray();
    }

    /**
     * @return object|null
     */
    public function extractFirstJson(): ?object
    {
        preg_match_all('
        /
        \{              # { character
            (?:         # non-capturing group
                [^{}]   # anything that is not a { or }
                |       # OR
                (?R)    # recurses the entire pattern
            )*          # previous group zero or more times
        \}              # } character
        /x
        ', $this->outputCollector()->implode(''), $matches);
        return ($result = json_decode($matches[0][0] ?? '')) ? (object)$result : null;
    }

    /**
     * @return object
     * @throws LogExtractionException
     */
    public function extractFirstJsonOrFail(): object
    {
        if ($object = $this->extractFirstJson()) {
            return $object;
        }
        throw new LogExtractionException("No JSON extracted from:{$this->outputCollector()->implode("\n")}");
    }

    /**
     * @param int|null $exitCode
     */
    public function setExitCode(?int $exitCode)
    {
        $this->exitCode ??= $exitCode;
    }
}
