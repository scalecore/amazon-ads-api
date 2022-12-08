<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles;

use ScaleCore\AmazonAds\Enums\CountryCode;
use ScaleCore\AmazonAds\Enums\CurrencyCode;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class Profile extends BaseModel
{
    use JsonSerialize;

    /**
     * The profile identifier.
     */
    #[Json]
    public ?int $profileId;

    /**
     * The countryCode for a given country.
     */
    #[Json]
    public ?CountryCode $countryCode;

    /**
     * The currency used for all monetary values for entities under this profile.
     */
    #[Json]
    public ?CurrencyCode $currencyCode;

    /**
     * The profile daily budget.
     *
     * Note that this field applies to Sponsored Product campaigns for seller type accounts only.
     * Not supported for vendor type accounts
     */
    #[Json]
    public ?float $dailyBudget;

    /**
     * The time zone used for all date-based campaign management and reporting.
     */
    #[Json]
    public ?string $timezone;

    /**
     * Profile account info..
     */
    #[Json]
    public ?AccountInfo $accountInfo;
}
