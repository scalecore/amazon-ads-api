<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property string|null $advertiserId
 * @property string|null $advertiserName
 */
final class Advertiser extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of the advertiser.
     */
    #[Json]
    protected ?string $advertiserId;

    /**
     * The name of the advertiser.
     */
    #[Json]
    protected ?string $advertiserName;
}
