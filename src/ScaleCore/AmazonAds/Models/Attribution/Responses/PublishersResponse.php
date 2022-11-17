<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\Responses;

use ScaleCore\AmazonAds\Models\Attribution\Publisher;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property array<array-key, Publisher>|null $publishers
 */
final class PublishersResponse extends BaseModel
{
    use JsonSerialize;

    /** @var array<array-key, Publisher>|null */
    #[Json(type: Publisher::class)]
    protected ?array $publishers;
}
