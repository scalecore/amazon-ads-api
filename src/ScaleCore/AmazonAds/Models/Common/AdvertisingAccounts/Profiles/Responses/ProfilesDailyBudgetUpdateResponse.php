<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class ProfilesDailyBudgetUpdateResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * Array of ProfileResponse objects.
     *
     * @var array<array-key, ProfileResponse>|null
     */
    #[Json(type: ProfileResponse::class)]
    public ?array $profiles;
}
