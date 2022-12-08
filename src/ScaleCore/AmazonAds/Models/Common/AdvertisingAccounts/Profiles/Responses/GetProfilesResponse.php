<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\Profile;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class GetProfilesResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * Array of Profile objects.
     *
     * @var array<array-key, Profile>|null
     */
    #[Json(type: Profile::class)]
    public ?array $profiles;
}
