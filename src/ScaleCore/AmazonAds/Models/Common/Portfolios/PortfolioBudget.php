<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios;

use ScaleCore\AmazonAds\Enums\Common\Portfolio\PortfolioBudgetPolicy;
use ScaleCore\AmazonAds\Enums\CurrencyCode;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class PortfolioBudget extends BaseModel
{
    use JsonSerialize;

    /**
     * The budget amount associated with a portfolio.
     */
    #[Json]
    public float $amount;

    /**
     * The currency used for all monetary values for entities under this profile.
     */
    #[Json]
    public CurrencyCode $currencyCode;

    /**
     * The budget policy.
     *
     * Set to dateRange to specify a budget for a specific period of time.
     * Set to monthlyRecurring to specify a budget that is automatically renewed at the beginning of each month.
     */
    #[Json]
    public PortfolioBudgetPolicy $policy;

    /**
     * The starting date in YYYYMMDD format to which the budget is applied.
     *
     * Required if policy is set to dateRange.
     * Not specified if policy is set to monthlyRecurring.
     *
     * Note that the starting date for monthlyRecurring is the date when the policy is set.
     */
    #[Json]
    public ?PortfolioBudgetDateTime $startDate;

    /**
     * The end date in YYYYMMDD format after which the budget is no longer applied.
     *
     * Optional if policy is set to dateRange or monthlyRecurring.
     */
    #[Json]
    public ?PortfolioBudgetDateTime $endDate;
}
