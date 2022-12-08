<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\ManagerAccounts;

enum AccountRelationshipRole: string
{
    case ENTITY_OWNER  = 'ENTITY_OWNER';
    case ENTITY_USER   = 'ENTITY_USER';
    case ENTITY_VIEWER = 'ENTITY_VIEWER';
    case SELLER_USER   = 'SELLER_USER';
}
