<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\ManagerAccounts;

enum AccountRelationshipIdType: string
{
    case ACCOUNT_ID        = 'ACCOUNT_ID';
    case DSP_ADVERTISER_ID = 'DSP_ADVERTISER_ID';
}
