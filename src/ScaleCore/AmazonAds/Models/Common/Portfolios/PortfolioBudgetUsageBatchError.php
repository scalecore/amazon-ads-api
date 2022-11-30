<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class PortfolioBudgetUsageBatchError extends BaseModel
{
    use JsonSerialize;

    /**
     * The portfolio identifier.
     */
    #[Json]
    public ?string $portfolioId;

    /**
     * An enumerated error code for machine use.
     */
    #[Json]
    public ?string $code;

    /**
     * An index to maintain order of the portfolioIds.
     */
    #[Json]
    public ?int $index;

    /**
     * A human-readable description of the response.
     */
    #[Json]
    public ?string $details;
}
