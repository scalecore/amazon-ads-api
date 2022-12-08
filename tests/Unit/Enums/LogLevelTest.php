<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Enums\LogLevel;

test(
    'LogLevel enum instantiation using `fromLabel` method and invalid value',
    function () {
        $val = LogLevel::fromLabel('SOME BS VALUE');
    }
)->throws(\ValueError::class);

test(
    'LogLevel enum instantiation using `fromLabel` method and valid value',
    function () {
        foreach (LogLevel::cases() as $logLevel) {
            expect(LogLevel::fromLabel($logLevel->label()))->toEqual($logLevel);
        }
    }
);

test(
    'LogLevel enum instantiation using `tryFromLabel` method and invalid value returns null',
    function () {
        expect(LogLevel::tryFromLabel('SOME BS VALUE'))->toBeNull();
    }
);

test(
    'LogLevel enum instantiation using `tryFromLabel` method and valid value',
    function () {
        foreach (LogLevel::cases() as $logLevel) {
            expect(LogLevel::tryFromLabel($logLevel->label()))->toEqual($logLevel);
        }
    }
);

test(
    'LogLevel label method',
    function () {
        expect(LogLevel::EMERGENCY->label())->toEqual(\Psr\Log\LogLevel::EMERGENCY);
        expect(LogLevel::ALERT->label())->toEqual(\Psr\Log\LogLevel::ALERT);
        expect(LogLevel::CRITICAL->label())->toEqual(\Psr\Log\LogLevel::CRITICAL);
        expect(LogLevel::ERROR->label())->toEqual(\Psr\Log\LogLevel::ERROR);
        expect(LogLevel::WARNING->label())->toEqual(\Psr\Log\LogLevel::WARNING);
        expect(LogLevel::NOTICE->label())->toEqual(\Psr\Log\LogLevel::NOTICE);
        expect(LogLevel::INFO->label())->toEqual(\Psr\Log\LogLevel::INFO);
        expect(LogLevel::DEBUG->label())->toEqual(\Psr\Log\LogLevel::DEBUG);
    }
);
