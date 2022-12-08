<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts;

use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\ManagerAccounts\AdvertisingAccountType;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * Object representation of an Amazon Advertising account.
 */
final class AdvertisingAccount extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of a profile associated with the advertiser account.
     *
     * Note that this value is only populated for a subset of account types: [ SELLER, VENDOR, MARKETING_CLOUD ].
     * It will be null for accounts of other types.
     */
    #[Json]
    public ?string $profileId;

    /**
     * The identifier of the marketplace to which the account is associated.
     *
     * @see https://docs.developer.amazonservices.com/en_US/dev_guide/DG_Endpoints.html
     */
    #[Json]
    public ?string $marketplaceId;

    /**
     * The id of the Amazon Advertising account.
     */
    #[Json]
    public ?string $accountId;

    /**
     * The name given to the Amazon Advertising account.
     */
    #[Json]
    public ?string $accountName;

    /**
     * Type of the Amazon Advertising account.
     */
    #[Json]
    public ?AdvertisingAccountType $accountType;

    /**
     * The identifier of a DSP advertiser.
     *
     * Note that this value is only populated for accounts with type DSP_ADVERTISING_ACCOUNT.
     * It will be null for accounts of other types.
     */
    #[Json]
    public ?string $dspAdvertiserId;
}
