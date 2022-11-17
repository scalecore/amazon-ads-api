<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property string|null $id
 * @property string|null $name
 * @property bool|null   $macroEnabled
 */
final class Publisher extends BaseModel
{
    use JsonSerialize;

    /**
     * The identifier of a publisher.
     */
    #[Json]
    protected ?string $id;

    /**
     * The name of the publisher.
     */
    #[Json]
    protected ?string $name;

    /**
     * Set to 'true' if Amazon Attribution provides macro tags for the given publisher.
     */
    #[Json]
    protected ?bool $macroEnabled;
}
