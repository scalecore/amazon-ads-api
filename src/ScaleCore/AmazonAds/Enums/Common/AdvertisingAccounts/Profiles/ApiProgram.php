<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles;

enum ApiProgram: string
{
    case BILLING        = 'billing';
    case CAMPAIGN       = 'campaign';
    case PAYMENT_METHOD = 'paymentMethod';
    case STORE          = 'store';
    case REPORT         = 'report';
    case ACCOUNT        = 'account';
    case POSTS          = 'posts';
}
