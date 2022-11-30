<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use ScaleCore\AmazonAds\Models\Common\Portfolios\Portfolio;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class GetPortfoliosResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * Array of Portfolio objects.
     *
     * @var array<array-key, Portfolio>|null
     */
    #[Json(type: Portfolio::class)]
    public ?array $portfolios;
}
