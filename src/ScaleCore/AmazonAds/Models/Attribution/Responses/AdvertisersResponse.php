<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\Responses;

use ScaleCore\AmazonAds\Models\Attribution\Advertiser;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property array<array-key, Advertiser>|null $advertisers
 */
final class AdvertisersResponse extends BaseModel
{
    use JsonSerialize;

    /** @var array<array-key, Advertiser>|null */
    #[Json(type: Advertiser::class)]
    protected ?array $advertisers;
}
