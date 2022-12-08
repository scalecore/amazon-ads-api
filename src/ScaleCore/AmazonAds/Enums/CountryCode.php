<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums;

enum CountryCode: string
{
    /* North America (NA) */
    case US = 'US';
    case CA = 'CA';
    case MX = 'MX';
    case BR = 'BR';

    /* Europe (EU) */
    case UK = 'UK';
    case GB = 'GB';
    case EG = 'EG';
    case DE = 'DE';
    case FR = 'FR';
    case ES = 'ES';
    case IT = 'IT';
    case NL = 'NL';
    case AE = 'AE';
    case SE = 'SE';
    case PL = 'PL';
    case TR = 'TR';

    /* Far East (FE) */
    case JP = 'JP';
    case AU = 'AU';
    case SG = 'SG';

    public function description(): string
    {
        return match ($this) {
            self::US => 'United States',
            self::CA => 'Canada',
            self::MX => 'Mexico',
            self::BR => 'Brazil',
            self::UK => 'United Kingdom',
            self::GB => 'United Kingdom (Great Britain)',
            self::EG => 'Egypt',
            self::DE => 'Germany',
            self::FR => 'France',
            self::ES => 'Spain',
            self::IT => 'Italy',
            self::NL => 'The Netherlands',
            self::AE => 'United Arab Emirates',
            self::SE => 'Sweden',
            self::PL => 'Poland',
            self::TR => 'Turkey',
            self::JP => 'Japan',
            self::AU => 'Australia',
            self::SG => 'Singapore',
        };
    }
}
