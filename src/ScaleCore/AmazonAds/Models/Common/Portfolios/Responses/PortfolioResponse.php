<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\Responses;

use ScaleCore\AmazonAds\Models\MutationResponse;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class PortfolioResponse extends MutationResponse
{
    use JsonSerialize;

    /**
     * The ID of the portfolio that was created/updated, if successful.
     */
    #[Json]
    public ?int $portfolioId;
}
