<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios;

use ScaleCore\AmazonAds\Enums\Common\Portfolio\PortfolioState;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class Portfolio extends BaseModel
{
    use JsonSerialize;

    /**
     * The portfolio identifier.
     */
    #[Json]
    public ?int $portfolioId;

    /**
     * The portfolio name.
     */
    #[Json]
    public string $name;

    /**
     * The portfolio budget.
     */
    #[Json]
    public ?PortfolioBudget $budget;

    /**
     * The portfolio nameIndicates the current budget status of the portfolio.
     *
     * Set to true if the portfolio is in budget, set to false if the portfolio is out of budget.
     */
    #[Json]
    public ?bool $inBudget;

    /**
     * The current state of the portfolio.
     */
    #[Json]
    public ?PortfolioState $state;
}
