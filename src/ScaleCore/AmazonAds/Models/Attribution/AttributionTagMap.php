<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property string|null $advertiserId
 * @property string|null $publisherId
 * @property bool|null   $supportsMacros
 * @property string|null $tagText
 */
final class AttributionTagMap extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of the advertiser.
     */
    #[Json]
    protected ?string $advertiserId;

    /**
     * The identifier of the publisher.
     */
    #[Json]
    protected ?string $publisherId;

    /**
     * Boolean identifier denoting whether the tag supports macros.
     */
    #[Json]
    protected ?bool $supportsMacros;

    /**
     * The text of the tag.
     */
    #[Json]
    protected ?string $tagText;
}
