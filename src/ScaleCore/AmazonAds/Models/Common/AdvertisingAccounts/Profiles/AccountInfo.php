<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles;

use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles\AccountSubType;
use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles\AccountType;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class AccountInfo extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of the marketplace to which the account is associated.
     */
    #[Json]
    public ?string $marketplaceStringId;

    /**
     * Identifier for sellers and vendors.
     *
     * Note that this value is not unique and may be the same across marketplace.
     */
    #[Json]
    public ?string $id;

    /**
     * Account Name.
     *
     * NOTE: Not currently populated for sellers.
     */
    #[Json]
    public ?string $name;

    /**
     * The seller and vendor account types are associated with Sponsored Ads APIs.
     * The agency account type is associated with DSP and Data Provider APIs.
     */
    #[Json]
    public ?AccountType $type;

    /**
     * The account subtype.
     */
    #[Json]
    public ?AccountSubType $subType;

    /**
     * This returns whether the Advertiser has set up a valid payment method or not.
     *
     * NOTE: Only present for Vendors.
     */
    #[Json]
    public ?bool $validPaymentMethod;
}
