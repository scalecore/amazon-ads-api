<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Enums\LogLevel;
use ScaleCore\AmazonAds\LoggerConfiguration;

beforeEach(
    function () {
        $this->headers = [
            'x-test-header-0',
            'x-test-header-1',
            'x-test-header-2',
        ];

        $this->apis = [
            'TestApi0' => [
                'TestApiOperation0',
                'TestApiOperation1',
                'TestApiOperation2',
            ],
            'TestApi1' => [
                'TestApiOperation0',
                'TestApiOperation1',
                'TestApiOperation2',
            ],
            'TestApi2' => [
                'TestApiOperation0',
                'TestApiOperation1',
                'TestApiOperation2',
            ],
        ];

        $this->loggerConfiguration = new LoggerConfiguration();

        $this->addSkippedHeaders = function (): void {
            foreach ($this->headers as $header) {
                $this->loggerConfiguration->addSkippedHeader($header);
            }
        };

        $this->addSkippedApis = function (): void {
            foreach (array_keys($this->apis) as $api) {
                $this->loggerConfiguration->skipAPI($api);
            }
        };

        $this->addSkippedApiOperations = function (): void {
            foreach ($this->apis as $api => $apiOperations) {
                foreach ($apiOperations as $apiOperation) {
                    $this->loggerConfiguration->skipAPIOperation($api, $apiOperation);
                }
            }
        };
    }
);

afterEach(
    function () {
        $this->headers             = [];
        $this->apis                = [];
        $this->loggerConfiguration = null;
    }
);

test(
    'LoggerConfiguration class object instantiation',
    function () {
        expect($this->loggerConfiguration)->toBeInstanceOf(LoggerConfiguration::class);
        expect(new LoggerConfiguration(LogLevel::ERROR))->toBeInstanceOf(LoggerConfiguration::class);
    }
);

test(
    'LoggerConfiguration can skip headers',
    function () {
        $defaultSkippedHeaders = $this->loggerConfiguration->getSkippedHeaders();

        ($this->addSkippedHeaders)();

        expect($this->loggerConfiguration->getSkippedHeaders())->toMatchArray(\array_merge($defaultSkippedHeaders, $this->headers));
        expect($this->loggerConfiguration->headerIsSkipped('NotSkippedHeader'))->toBeFalse();
    }
);

test(
    'LoggerConfiguration can remove skipped headers',
    function () {
        ($this->addSkippedHeaders)();

        $this->loggerConfiguration->removeSkippedHeader($this->headers[0]);
        $this->loggerConfiguration->removeSkippedHeader($this->headers[1]);

        $skippedHeaders = $this->loggerConfiguration->getSkippedHeaders();

        expect($skippedHeaders)->toContain($this->headers[2]);

        $this->assertNotContains($this->headers[0], $skippedHeaders);
        $this->assertNotContains($this->headers[1], $skippedHeaders);
    }
);

test(
    'LoggerConfiguration can skip API logging',
    function () {
        ($this->addSkippedApis)();

        foreach (array_keys($this->apis) as $api) {
            expect($this->loggerConfiguration->isSkipped($api))->toBeTrue();
        }

        expect($this->loggerConfiguration->isSkipped('NotSkippedAPI'))->toBeFalse();
    }
);

test(
    'LoggerConfiguration can enable API logging',
    function () {
        ($this->addSkippedApis)();

        $apis = array_keys($this->apis);

        $this->loggerConfiguration->enableAPI($apis[0]);

        expect($this->loggerConfiguration->isSkipped($apis[0]))->toBeFalse();
        expect($this->loggerConfiguration->isSkipped($apis[1]))->toBeTrue();
        expect($this->loggerConfiguration->isSkipped($apis[2]))->toBeTrue();
    }
);

test(
    'LoggerConfiguration can enable API logging with operations',
    function () {
        ($this->addSkippedApiOperations)();

        $apiToEnable = array_keys($this->apis)[0];

        $this->loggerConfiguration->enableAPI($apiToEnable);

        foreach ($this->apis as $api => $apiOperations) {
            foreach ($apiOperations as $apiOperation) {
                if ($api === $apiToEnable) {
                    expect($this->loggerConfiguration->isSkipped($api, $apiOperation))->toBeFalse();

                    continue;
                }

                expect($this->loggerConfiguration->isSkipped($api, $apiOperation))->toBeTrue();
            }
        }
    }
);

test(
    'LoggerConfiguration can skip API logging operation',
    function () {
        ($this->addSkippedApiOperations)();

        foreach ($this->apis as $api => $apiOperations) {
            foreach ($apiOperations as $apiOperation) {
                expect($this->loggerConfiguration->isSkipped($api, $apiOperation))->toBeTrue();
            }
        }

        foreach (\array_keys($this->apis) as $api) {
            expect($this->loggerConfiguration->isSkipped($api, 'NotSkippedOperation'))->toBeFalse();
        }
    }
);

test(
    'LoggerConfiguration can enable API logging operation',
    function () {
        ($this->addSkippedApiOperations)();

        $apiToEnable          = array_keys($this->apis)[0];
        $apiOperationToEnable = $this->apis[$apiToEnable][1];

        $this->loggerConfiguration->enableAPIOperation($apiToEnable, $apiOperationToEnable);
        $this->loggerConfiguration->enableAPIOperation('Not Skipped API Operation', $apiOperationToEnable);

        foreach ($this->apis as $api => $apiOperations) {
            foreach ($apiOperations as $apiOperation) {
                if ($api === $apiToEnable && $apiOperation === $apiOperationToEnable) {
                    expect($this->loggerConfiguration->isSkipped($api, $apiOperation))->toBeFalse();

                    continue;
                }

                expect($this->loggerConfiguration->isSkipped($api, $apiOperation))->toBeTrue();
            }
        }

        $this->loggerConfiguration->enableAPIOperation($apiToEnable, $this->apis[$apiToEnable][0]);
        $this->loggerConfiguration->enableAPIOperation($apiToEnable, $this->apis[$apiToEnable][2]);
    }
);

test(
    'LoggerConfiguration log level',
    function () {
        $api             = 'SomeApi';
        $operation       = 'someOperation';
        $defaultLogLevel = LogLevel::DEBUG;
        $testLogLevel    = LogLevel::ERROR;

        expect($this->loggerConfiguration->getLogLevel($api, $operation))->toEqual($defaultLogLevel);

        $this->loggerConfiguration->setDefaultLogLevel($testLogLevel);

        expect($this->loggerConfiguration->getLogLevel($api, $operation))->toEqual($testLogLevel);

        $this->loggerConfiguration->setDefaultLogLevel($defaultLogLevel);

        $this->loggerConfiguration->setLogLevel($api, $operation, $testLogLevel);

        expect($this->loggerConfiguration->getLogLevel($api, $operation))->toEqual($testLogLevel);
    }
);
