<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds;

use ScaleCore\AmazonAds\Contracts\HttpRequestAuthInterface;

final class Configuration
{
    private string $userAgent;

    private string $tmpFolderPath;

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
}
