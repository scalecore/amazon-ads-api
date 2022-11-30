<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use ScaleCore\AmazonAds\Models\Common\Portfolios\PortfolioBudgetUsage;
use ScaleCore\AmazonAds\Models\Common\Portfolios\PortfolioBudgetUsageBatchError;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class PortfolioBudgetUsageResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * List of budget usage percentages that were successfully pulled.
     *
     * @var array<array-key, PortfolioBudgetUsage>|null
     */
    #[Json(type: PortfolioBudgetUsage::class)]
    public ?array $success;

    /**
     * List of budget usage percentages that failed to pull.
     *
     * @var array<array-key, PortfolioBudgetUsageBatchError>|null
     */
    #[Json(type: PortfolioBudgetUsageBatchError::class)]
    public ?array $error;
}
