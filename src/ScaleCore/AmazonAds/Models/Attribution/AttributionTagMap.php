<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class AttributionTagMap extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of the advertiser.
     */
    #[Json]
    public ?string $advertiserId;

    /**
     * The identifier of the publisher.
     */
    #[Json]
    public ?string $publisherId;

    /**
     * Boolean identifier denoting whether the tag supports macros.
     */
    #[Json]
    public ?bool $supportsMacros;

    /**
     * The text of the tag.
     */
    #[Json]
    public ?string $tagText;
}
