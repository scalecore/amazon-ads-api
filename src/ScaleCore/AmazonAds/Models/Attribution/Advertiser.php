<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class Advertiser extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of the advertiser.
     */
    #[Json]
    public ?string $advertiserId;

    /**
     * The name of the advertiser.
     */
    #[Json]
    public ?string $advertiserName;
}
