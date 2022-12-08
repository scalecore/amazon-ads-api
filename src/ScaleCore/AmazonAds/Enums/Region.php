<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums;

use ScaleCore\AmazonAds\Enums\CountryCode as CC;

enum Region: string
{
    case NORTH_AMERICA  = 'NA';
    case EUROPEAN_UNION = 'EU';
    case FAR_EAST       = 'FE';

    /**
     * @throws \ValueError
     */
    public static function fromCountryCode(string|CC $code): self
    {
        $code = \is_string($code) ? CC::from(strtoupper($code)) : $code;

        return match ($code) {
            CC::US,
            CC::CA,
            CC::MX,
            CC::BR => self::NORTH_AMERICA,
            CC::UK,
            CC::GB,
            CC::EG,
            CC::DE,
            CC::FR,
            CC::ES,
            CC::IT,
            CC::NL,
            CC::AE,
            CC::SE,
            CC::PL,
            CC::TR => self::EUROPEAN_UNION,
            CC::JP,
            CC::AU,
            CC::SG => self::FAR_EAST,
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::NORTH_AMERICA  => 'North America (NA). Covers US, CA, MX, and BR marketplaces',
            self::EUROPEAN_UNION => 'Europe (EU). Covers UK, FR, IT, ES, DE, NL, AE, PL, TR, and EG marketplaces',
            self::FAR_EAST       => 'Far East (FE). Covers JP, AU, and SG marketplaces',
        };
    }

    public function host(): string
    {
        return match ($this) {
            self::NORTH_AMERICA  => 'advertising-api.amazon.com',
            self::EUROPEAN_UNION => 'advertising-api-eu.amazon.com',
            self::FAR_EAST       => 'advertising-api-fe.amazon.com',
        };
    }

    public function url(): string
    {
        return 'https://' . $this->host();
    }
}
