<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class CreateOrUpdatePortfoliosResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * Array of PortfolioResponse objects.
     *
     * @var array<array-key, PortfolioResponse>|null
     */
    #[Json(type: PortfolioResponse::class)]
    public ?array $portfolios;
}
