<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds;

use ScaleCore\AmazonAds\Contracts\HttpRequestAuthInterface;
use ScaleCore\AmazonAds\Contracts\IdGenerator;
use ScaleCore\AmazonAds\Enums\LogLevel;
use ScaleCore\AmazonAds\Support\UniqidGenerator;

final class Configuration
{
    private string $userAgent;

    private string $tmpFolderPath;

    public function __construct(
        private readonly HttpRequestAuthInterface $httpRequestAuth,
        private readonly LoggerConfiguration $loggerConfiguration = new LoggerConfiguration(),
        private IdGenerator $idGenerator = new UniqidGenerator()
    ) {
        $this->userAgent = \sprintf(
            'Library scalecore/amazon-ads-api (language=PHP %s; Platform=%s %s %s)',
            \phpversion(),
            \php_uname('s'),
            \php_uname('r'),
            \php_uname('m')
        );
        $this->tmpFolderPath = \sys_get_temp_dir();
    }

    /**
     * Gets the LWA client identifier for API requests.
     */
    public function getLwaClientID(): string
    {
        return $this->httpRequestAuth->getClientId();
    }

    /**
     * Gets the libraries user agent header string identifier for API requests.
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * Sets the libraries user agent header string identifier for API requests.
     */
    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * Gets the application temp folder path.
     */
    public function getTmpFolderPath(): string
    {
        return $this->tmpFolderPath;
    }

    /**
     * Sets the application temp folder path.
     */
    public function setTmpFolderPath(string $tmpFolderPath): self
    {
        $this->tmpFolderPath = $tmpFolderPath;

        return $this;
    }

    /**
     * Gets the applications logger configuration.
     */
    public function getLoggerConfiguration(): LoggerConfiguration
    {
        return $this->loggerConfiguration;
    }

    /**
     * Gets the application HTTP request authorization object.
     */
    public function getHttpRequestAuth(): HttpRequestAuthInterface
    {
        return $this->httpRequestAuth;
    }

    /**
     * Sets the application default log level.
     */
    public function setDefaultLogLevel(LogLevel $logLevel): self
    {
        $this->loggerConfiguration->setDefaultLogLevel($logLevel);

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
        $this->loggerConfiguration->setLogLevel($api, $operation, $logLevel);

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
        return $this->loggerConfiguration->getLogLevel($api, $operation);
    }

    /**
     * Sets the logging to be skipped for an api or operation.
     *
     * @param string      $api       The API class name
     * @param string|null $operation The API method name, if null entire API skipped
     */
    public function setSkipLogging(string $api, string $operation = null): self
    {
        if ($operation !== null) {
            $this->loggerConfiguration->skipAPIOperation($api, $operation);

            return $this;
        }

        $this->loggerConfiguration->skipAPI($api);

        return $this;
    }

    /**
     * Sets the logging to be enabled for an api or operation.
     *
     * @param string      $api       The API class name
     * @param string|null $operation The API method name, if null entire API enabled
     */
    public function setEnableLogging(string $api, string $operation = null): self
    {
        if ($operation !== null) {
            $this->loggerConfiguration->enableAPIOperation($api, $operation);

            return $this;
        }

        $this->loggerConfiguration->enableAPI($api);

        return $this;
    }

    /**
     * Returns wether the logging is enabled for an api or operation.
     *
     * @param string      $api       The API class name
     * @param string|null $operation The API method name, if null API status returned
     */
    public function loggingEnabled(string $api, string $operation = null): bool
    {
        return ! $this->loggerConfiguration->isSkipped($api, $operation);
    }

    /**
     * Add header to be skipped/not included in logged output.
     */
    public function loggingAddSkippedHeader(string $headerName): self
    {
        $this->loggerConfiguration->addSkippedHeader($headerName);

        return $this;
    }

    /**
     * Remove header from list of headers skipped/not included in logged output.
     */
    public function loggingRemoveSkippedHeader(string $headerName): self
    {
        $this->loggerConfiguration->removeSkippedHeader($headerName);

        return $this;
    }

    /**
     * Return the list of headers excluded from the logged output.
     *
     * @return array<array-key, string>
     */
    public function loggingSkipHeaders(): array
    {
        return $this->loggerConfiguration->getSkippedHeaders();
    }

    /**
     * Return the IDGenerator used to generate unique id's attached to logging.
     */
    public function getIdGenerator(): IdGenerator
    {
        return $this->idGenerator;
    }

    /**
     * Set the IDGenerator used to generate unique id's attached to logging.
     */
    public function setIdGenerator(IdGenerator $idGenerator): self
    {
        $this->idGenerator = $idGenerator;

        return $this;
    }
}
