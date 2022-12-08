<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\ManagerAccounts;

enum ManagerAccountType: string
{
    case ADVERTISER = 'Advertiser';
    case AGENCY     = 'Agency';
}
