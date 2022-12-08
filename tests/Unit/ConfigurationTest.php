<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Configuration;
use ScaleCore\AmazonAds\Contracts\HttpRequestAuthInterface;
use ScaleCore\AmazonAds\LoggerConfiguration;

beforeEach(
    function () {
        $this->lwaClientID = 'test client id';

        $this->httpRequestAuth = mock(HttpRequestAuthInterface::class)
            ->shouldReceive('getClientId')
            ->andReturn($this->lwaClientID)
            ->getMock();

        $this->loggerConfiguration = new LoggerConfiguration();

        $this->config = getConfiguration(
            $this->httpRequestAuth,
            $this->loggerConfiguration
        );

        $this->userAgent = sprintf(
            'Library scalecore/amazon-ads-api (language=PHP %s; Platform=%s %s %s)',
            \phpversion(),
            \php_uname('s'),
            \php_uname('r'),
            \php_uname('m')
        );

        $this->tmpFolderPath = \sys_get_temp_dir();
    }
);

afterEach(
    function () {
        $this->lwaClientID         = '';
        $this->httpRequestAuth     = null;
        $this->loggerConfiguration = null;
        $this->userAgent           = '';
        $this->tmpFolderPath       = '';
        $this->config              = null;
    }
);

test(
    'Configuration is valid',
    function () {
        expect($this->config)->toBeInstanceOf(Configuration::class);
        expect($this->config->getLwaClientID())->toEqual($this->lwaClientID);
        expect($this->config->getUserAgent())->toEqual($this->userAgent);
        expect($this->config->setUserAgent('SOME NEW UA')->getUserAgent())->toEqual('SOME NEW UA');
        expect($this->config->getTmpFolderPath())->toEqual($this->tmpFolderPath);
        expect($this->config->setTmpFolderPath('SOME TMP FOLDER')->getTmpFolderPath())->toEqual('SOME TMP FOLDER');
        expect($this->config->getLoggerConfiguration())->toEqual($this->loggerConfiguration);
        expect($this->config->getHttpRequestAuth())->toEqual($this->httpRequestAuth);
    }
);
