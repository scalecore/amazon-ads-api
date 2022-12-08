<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\AccountToUpdate;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\AccountToUpdateFailure;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class UpdateAdvertisingAccountsInManagerAccountResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * List of Advertising accounts or advertisers successfully Link/Unlink with Manager Account.
     *
     * @var array<array-key, AccountToUpdate>|null
     */
    #[Json(type: AccountToUpdate::class)]
    public ?array $succeedAccounts;

    /**
     * List of Advertising accounts or advertisers failed to Link/Unlink with Manager Account.
     *
     * @var array<array-key, AccountToUpdateFailure>|null
     */
    #[Json(type: AccountToUpdateFailure::class)]
    public ?array $failedAccounts;
}
