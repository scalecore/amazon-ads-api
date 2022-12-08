<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds;

use ScaleCore\AmazonAds\Enums\LogLevel;

final class LoggerConfiguration
{
    /**
     * @var array<string, array<string, LogLevel>>
     */
    private array $customLogLevels;

    /**
     * @var array<string>
     */
    private array $skippedAPIs;

    /**
     * @var array<string, array<string>>
     */
    private array $skippedAPIOperations;

    /**
     * @var array<string>
     */
    private array $skippedHttpHeaders;

    public function __construct(private LogLevel $defaultLogLevel = LogLevel::DEBUG)
    {
        $this->customLogLevels      = [];
        $this->skippedAPIs          = [];
        $this->skippedAPIOperations = [];
        $this->skippedHttpHeaders   = [
            'authorization',
            'x-amz-access-token',
            'x-amz-security-token',
            'proxy-authorization',
            'www-authenticate',
            'proxy-authenticate',
        ];
    }

    public function setDefaultLogLevel(LogLevel $logLevel): self
    {
        $this->defaultLogLevel = $logLevel;

        return $this;
    }

    public function setLogLevel(string $api, string $operation, LogLevel $logLevel): self
    {
        $this->customLogLevels[$api] ??= [];

        $this->customLogLevels[$api][$operation] = $logLevel;

        return $this;
    }

    public function getLogLevel(string $api, string $operation): LogLevel
    {
        return $this->customLogLevels[$api][$operation] ?? $this->defaultLogLevel;
    }

    public function skipAPI(string $api): self
    {
        if ( ! \in_array($api, $this->skippedAPIs, true)) {
            $this->skippedAPIs[] = $api;
        }

        return $this;
    }

    public function enableAPI(string $api): self
    {
        $apiKey = \array_search($api, $this->skippedAPIs, true);

        if ($apiKey !== false) {
            unset($this->skippedAPIs[$apiKey]);
        }

        unset($this->skippedAPIOperations[$api]);

        return $this;
    }

    public function skipAPIOperation(string $api, string $operation): self
    {
        $this->skippedAPIOperations[$api] ??= [];

        if ( ! \in_array($operation, $this->skippedAPIOperations[$api], true)) {
            $this->skippedAPIOperations[$api][] = $operation;
        }

        return $this;
    }

    public function enableAPIOperation(string $api, string $operation): self
    {
        if ( ! isset($this->skippedAPIOperations[$api])) {
            return $this;
        }

        $operationKey = \array_search($operation, $this->skippedAPIOperations[$api], true);

        if ($operationKey !== false) {
            unset($this->skippedAPIOperations[$api][$operationKey]);
        }

        if ($this->skippedAPIOperations[$api] === []) {
            unset($this->skippedAPIOperations[$api]);
        }

        return $this;
    }

    public function isSkipped(string $api, string $operation = null): bool
    {
        if (\in_array($api, $this->skippedAPIs, true)) {
            return true;
        }

        return \in_array($operation, $this->skippedAPIOperations[$api] ?? [], true);
    }

    public function addSkippedHeader(string $headerName): self
    {
        if ( ! \in_array(\strtolower($headerName), $this->skippedHttpHeaders, true)) {
            $this->skippedHttpHeaders[] = \strtolower($headerName);
        }

        return $this;
    }

    public function removeSkippedHeader(string $headerName): self
    {
        $headerKey = \array_search(\strtolower($headerName), $this->skippedHttpHeaders, true);

        if ($headerKey !== false) {
            unset($this->skippedHttpHeaders[$headerKey]);
        }

        return $this;
    }

    /**
     * @return array<array-key, string>
     */
    public function getSkippedHeaders(): array
    {
        return $this->skippedHttpHeaders;
    }

    public function headerIsSkipped(string $headerName): bool
    {
        return \in_array(\strtolower($headerName), $this->skippedHttpHeaders, true);
    }
}
