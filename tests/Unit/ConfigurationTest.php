<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Configuration;
use ScaleCore\AmazonAds\Contracts\HttpRequestAuthInterface;
use ScaleCore\AmazonAds\Contracts\IdGenerator;
use ScaleCore\AmazonAds\Enums\LogLevel;
use ScaleCore\AmazonAds\LoggerConfiguration;
use ScaleCore\AmazonAds\Support\UniqidGenerator;

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

test(
    'Configuration log levels are valid',
    function () {
        $this->config->setDefaultLogLevel(LogLevel::EMERGENCY);
        expect($this->config->getLogLevel('Non-existant API', 'Non-existant operation'))->toEqual(LogLevel::EMERGENCY);

        $this->config->setLogLevel('api', 'operation', LogLevel::CRITICAL);
        expect($this->config->getLogLevel('api', 'operation'))->toEqual(LogLevel::CRITICAL);
    }
);

test(
    'Configuration api and operation logging are valid',
    function () {
        $this->config->setSkipLogging('api');
        expect($this->config->loggingEnabled('api', 'operation'))->toBeFalse();
        expect($this->config->loggingEnabled('api'))->toBeFalse();

        $this->config->setEnableLogging('api');
        expect($this->config->loggingEnabled('api', 'operation'))->toBeTrue();
        expect($this->config->loggingEnabled('api'))->toBeTrue();

        $this->config->setSkipLogging('api', 'operation');
        expect($this->config->loggingEnabled('api', 'operation'))->toBeFalse();
        expect($this->config->loggingEnabled('api', 'other-operation'))->toBeTrue();
        expect($this->config->loggingEnabled('api'))->toBeTrue();

        $this->config->setEnableLogging('api', 'operation');
        expect($this->config->loggingEnabled('api', 'operation'))->toBeTrue();
        expect($this->config->loggingEnabled('api', 'other-operation'))->toBeTrue();
        expect($this->config->loggingEnabled('api'))->toBeTrue();
    }
);

test(
    'Configuration header logging is valid',
    function () {
        $this->config->loggingAddSkippedHeader('skipped-header');
        expect($this->config->loggingSkipHeaders())->toBeArray()->toContain('skipped-header');

        $this->config->loggingRemoveSkippedHeader('skipped-header');
        expect($this->config->loggingSkipHeaders())->toBeArray()->not->toContain('skipped-header');
    }
);

test(
    'Configuration ID Generator is valid',
    function () {
        expect($this->config->getIdGenerator())->toBeInstanceOf(IdGenerator::class);

        $idGenerator = new UniqidGenerator();
        $this->config->setIdGenerator($idGenerator);
        expect($this->config->getIdGenerator())->toEqual($idGenerator);
    }
);
