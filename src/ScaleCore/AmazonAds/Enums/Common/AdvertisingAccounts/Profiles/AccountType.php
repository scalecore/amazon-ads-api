<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles;

enum AccountType: string
{
    case SELLER = 'seller';
    case VENDOR = 'vendor';
    case AGENCY = 'agency';
}
