<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class ManagerAccount extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of a Manager Account.
     */
    #[Json]
    public ?string $managerAccountId;

    /**
     * The name given to a Manager Account.
     */
    #[Json]
    public ?string $managerAccountName;

    /**
     * A list of Accounts linked to a Manager Account.
     *
     * @var array<array-key, AdvertisingAccount>|null
     */
    #[Json(type: AdvertisingAccount::class)]
    public ?array $linkedAccounts;
}
