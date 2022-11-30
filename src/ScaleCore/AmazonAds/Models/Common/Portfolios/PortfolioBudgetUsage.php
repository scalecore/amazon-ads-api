<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class PortfolioBudgetUsage extends BaseModel
{
    use JsonSerialize;

    /**
     * The portfolio identifier.
     */
    #[Json]
    public ?string $portfolioId;

    /**
     * Budget usage percentage (spend / available budget) for the given budget policy.
     */
    #[Json]
    public ?float $budgetUsagePercent;

    /**
     * Last evaluation time for budget usage.
     */
    #[Json]
    public ?PortfolioBudgetUsageDateTime $usageUpdatedTimestamp;

    /**
     * An index to maintain order of the portfolioIds.
     */
    #[Json]
    public ?int $index;

    /**
     * Budget amount of resource requested.
     */
    #[Json]
    public ?float $budget;
}
