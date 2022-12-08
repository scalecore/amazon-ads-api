<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums;

use Psr\Log\LogLevel as PsrLogLevel;

enum LogLevel
{
    case EMERGENCY;
    case ALERT;
    case CRITICAL;
    case ERROR;
    case WARNING;
    case NOTICE;
    case INFO;
    case DEBUG;

    public function label(): string
    {
        return match ($this) {
            self::EMERGENCY => PsrLogLevel::EMERGENCY,
            self::ALERT     => PsrLogLevel::ALERT,
            self::CRITICAL  => PsrLogLevel::CRITICAL,
            self::ERROR     => PsrLogLevel::ERROR,
            self::WARNING   => PsrLogLevel::WARNING,
            self::NOTICE    => PsrLogLevel::NOTICE,
            self::INFO      => PsrLogLevel::INFO,
            self::DEBUG     => PsrLogLevel::DEBUG,
        };
    }

    public static function fromLabel(string $label): self
    {
        return self::tryFromLabel($label) ?? throw new \ValueError('Invalid log level value.');
    }

    public static function tryFromLabel(string $label): ?self
    {
        return match ($label) {
            PsrLogLevel::EMERGENCY => self::EMERGENCY,
            PsrLogLevel::ALERT     => self::ALERT,
            PsrLogLevel::CRITICAL  => self::CRITICAL,
            PsrLogLevel::ERROR     => self::ERROR,
            PsrLogLevel::WARNING   => self::WARNING,
            PsrLogLevel::NOTICE    => self::NOTICE,
            PsrLogLevel::INFO      => self::INFO,
            PsrLogLevel::DEBUG     => self::DEBUG,
            default                => null,
        };
    }
}
