<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts;

use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\ManagerAccounts\AccountRelationshipIdType;
use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\ManagerAccounts\AccountRelationshipRole;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class AccountToUpdate extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of the Amazon Advertising account.
     */
    #[Json]
    public ?string $id;

    /**
     * The type of the id.
     */
    #[Json]
    public ?AccountRelationshipIdType $type;

    /**
     * The type of role used in account relationships.
     *
     * The types of role that will exist with the Amazon Advertising account.
     * Depending on account type, the default role will be ENTITY_USER or SELLER_USER.
     *
     * Only one role at a time is currently supported
     *
     * @var array<array-key, AccountRelationshipRole>|null
     */
    #[Json(type: AccountRelationshipRole::class)]
    public ?array $roles;

    public function __construct(
        string $id,
        AccountRelationshipIdType $type,
        AccountRelationshipRole $role
    ) {
        $this->id    = $id;
        $this->type  = $type;
        $this->roles = [$role];
    }
}
