<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class ProfilesDailyBudgetUpdateResponse extends BaseModel
{
    use JsonSerialize {
        fromJsonData as traitFromJsonData;
    }

    /**
     * Array of ProfileResponse objects.
     *
     * @var array<array-key, ProfileResponse>|null
     */
    #[Json(type: ProfileResponse::class)]
    public ?array $profiles;

    /**
     * @param array<array-key, mixed>         $jd
     * @param array<array-key, string>|string $path
     */
    public static function fromJsonData($jd, array|string $path = []): static
    {
        return static::traitFromJsonData(['profiles' => $jd], $path);
    }
}
