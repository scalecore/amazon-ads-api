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

    /**
     * Sets the application default log level.
     */
    public function setDefaultLogLevel(LogLevel $logLevel): self
    {
        $this->defaultLogLevel = $logLevel;

        return $this;
    }

    /**
     * Sets the log level for an api operation.
     *
     * @param string $api       The API class name
     * @param string $operation The API method name
     */
    public function setLogLevel(string $api, string $operation, LogLevel $logLevel): self
    {
        $this->customLogLevels[$api] ??= [];

        $this->customLogLevels[$api][$operation] = $logLevel;

        return $this;
    }

    /**
     * Gets the log level for an api operation.
     *
     * @param string $api       The API class name
     * @param string $operation The API method name
     */
    public function getLogLevel(string $api, string $operation): LogLevel
    {
        return $this->customLogLevels[$api][$operation] ?? $this->defaultLogLevel;
    }

    /**
     * Sets the logging to be skipped for an api.
     *
     * @param string $api The API class name
     */
    public function skipAPI(string $api): self
    {
        if ( ! \in_array($api, $this->skippedAPIs, true)) {
            $this->skippedAPIs[] = $api;
        }

        return $this;
    }

    /**
     * Sets the logging to be enabled for an api.
     *
     * @param string $api The API class name
     */
    public function enableAPI(string $api): self
    {
        $apiKey = \array_search($api, $this->skippedAPIs, true);

        if ($apiKey !== false) {
            unset($this->skippedAPIs[$apiKey]);
        }

        unset($this->skippedAPIOperations[$api]);

        return $this;
    }

    /**
     * Sets the logging to be skipped for an api and operation.
     *
     * @param string $api       The API class name
     * @param string $operation The API method name
     */
    public function skipAPIOperation(string $api, string $operation): self
    {
        $this->skippedAPIOperations[$api] ??= [];

        if ( ! \in_array($operation, $this->skippedAPIOperations[$api], true)) {
            $this->skippedAPIOperations[$api][] = $operation;
        }

        return $this;
    }

    /**
     * Sets the logging to be enabled for an api and operation.
     *
     * @param string $api       The API class name
     * @param string $operation The API method name
     */
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

    /**
     * Returns wether the logging is skipped for an api and/or operation.
     *
     * @param string      $api       The API class name
     * @param string|null $operation The API method name, if null the API as a whole
     */
    public function isSkipped(string $api, string $operation = null): bool
    {
        if (\in_array($api, $this->skippedAPIs, true)) {
            return true;
        }

        return \in_array($operation, $this->skippedAPIOperations[$api] ?? [], true);
    }

    /**
     * Add header to be skipped/not included in logged output.
     */
    public function addSkippedHeader(string $headerName): self
    {
        if ( ! \in_array(\strtolower($headerName), $this->skippedHttpHeaders, true)) {
            $this->skippedHttpHeaders[] = \strtolower($headerName);
        }

        return $this;
    }

    /**
     * Remove header from list of headers skipped/not included in logged output.
     */
    public function removeSkippedHeader(string $headerName): self
    {
        $headerKey = \array_search(\strtolower($headerName), $this->skippedHttpHeaders, true);

        if ($headerKey !== false) {
            unset($this->skippedHttpHeaders[$headerKey]);
        }

        return $this;
    }

    /**
     * Return the list of headers excluded from the logged output.
     *
     * @return array<array-key, string>
     */
    public function getSkippedHeaders(): array
    {
        return $this->skippedHttpHeaders;
    }

    /**
     * Return wether the header is skipped/not included in logged output.
     */
    public function headerIsSkipped(string $headerName): bool
    {
        return \in_array(\strtolower($headerName), $this->skippedHttpHeaders, true);
    }
}
