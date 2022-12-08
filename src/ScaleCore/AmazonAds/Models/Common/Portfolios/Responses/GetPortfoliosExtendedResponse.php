<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use ScaleCore\AmazonAds\Models\Common\Portfolios\PortfolioEx;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class GetPortfoliosExtendedResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * Array of PortfolioEx objects.
     *
     * @var array<array-key, PortfolioEx>|null
     */
    #[Json(type: PortfolioEx::class)]
    public ?array $portfolios;
}
