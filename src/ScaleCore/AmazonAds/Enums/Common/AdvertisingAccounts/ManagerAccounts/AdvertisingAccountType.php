<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\ManagerAccounts;

enum AdvertisingAccountType: string
{
    case VENDOR                  = 'VENDOR';
    case SELLER                  = 'SELLER';
    case DSP_ADVERTISING_ACCOUNT = 'DSP_ADVERTISING_ACCOUNT';
    case MARKETING_CLOUD         = 'MARKETING_CLOUD';
}
