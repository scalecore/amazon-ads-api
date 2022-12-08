<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\ManagerAccount;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * Response containing a list of Manager Accounts that a given user has access to.
 */
final class GetManagerAccountsResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * List of Manager Accounts that the user has access to.
     *
     * @var array<array-key, ManagerAccount>|null
     */
    #[Json(type: ManagerAccount::class)]
    public ?array $managerAccounts;
}
