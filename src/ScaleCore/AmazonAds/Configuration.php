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

    private IdGenerator $idGenerator;

    public function __construct(
        private readonly HttpRequestAuthInterface $httpRequestAuth,
        private readonly LoggerConfiguration $loggerConfiguration = new LoggerConfiguration()
    ) {
        $this->userAgent = \sprintf(
            'Library scalecore/amazon-ads-api (language=PHP %s; Platform=%s %s %s)',
            \phpversion(),
            \php_uname('s'),
            \php_uname('r'),
            \php_uname('m')
        );
        $this->tmpFolderPath = \sys_get_temp_dir();
        $this->idGenerator   = new UniqidGenerator();
    }

    public function getLwaClientID(): string
    {
        return $this->httpRequestAuth->getClientId();
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    public function getTmpFolderPath(): string
    {
        return $this->tmpFolderPath;
    }

    public function setTmpFolderPath(string $tmpFolderPath): self
    {
        $this->tmpFolderPath = $tmpFolderPath;

        return $this;
    }

    public function getLoggerConfiguration(): LoggerConfiguration
    {
        return $this->loggerConfiguration;
    }

    public function getHttpRequestAuth(): HttpRequestAuthInterface
    {
        return $this->httpRequestAuth;
    }

    public function setDefaultLogLevel(LogLevel $logLevel): self
    {
        $this->loggerConfiguration->setDefaultLogLevel($logLevel);

        return $this;
    }

    public function setLogLevel(string $api, string $operationMethod, LogLevel $logLevel): self
    {
        $this->loggerConfiguration->setLogLevel($api, $operationMethod, $logLevel);

        return $this;
    }

    public function getLogLevel(string $api, string $operation): LogLevel
    {
        return $this->loggerConfiguration->getLogLevel($api, $operation);
    }

    public function setSkipLogging(string $api, string $operation = null): self
    {
        if ($operation !== null) {
            $this->loggerConfiguration->skipAPIOperation($api, $operation);

            return $this;
        }

        $this->loggerConfiguration->skipAPI($api);

        return $this;
    }

    public function setEnableLogging(string $api, string $operation = null): self
    {
        if ($operation !== null) {
            $this->loggerConfiguration->enableAPIOperation($api, $operation);

            return $this;
        }

        $this->loggerConfiguration->enableAPI($api);

        return $this;
    }

    public function loggingEnabled(string $api, string $operation = null): bool
    {
        return ! $this->loggerConfiguration->isSkipped($api, $operation);
    }

    public function loggingAddSkippedHeader(string $headerName): self
    {
        $this->loggerConfiguration->addSkippedHeader($headerName);

        return $this;
    }

    public function loggingRemoveSkippedHeader(string $headerName): self
    {
        $this->loggerConfiguration->removeSkippedHeader($headerName);

        return $this;
    }

    /**
     * @return array<array-key, string>
     */
    public function loggingSkipHeaders(): array
    {
        return $this->loggerConfiguration->getSkippedHeaders();
    }

    public function getIdGenerator(): IdGenerator
    {
        return $this->idGenerator;
    }

    public function setIdGenerator(IdGenerator $idGenerator): self
    {
        $this->idGenerator = $idGenerator;

        return $this;
    }
}
