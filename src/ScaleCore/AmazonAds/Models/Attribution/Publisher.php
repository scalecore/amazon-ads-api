<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class Publisher extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of a publisher.
     */
    #[Json]
    public ?string $id;

    /**
     * The name of the publisher.
     */
    #[Json]
    public ?string $name;

    /**
     * Set to 'true' if Amazon Attribution provides macro tags for the given publisher.
     */
    #[Json]
    public ?bool $macroEnabled;
}
