<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios;

use ScaleCore\AmazonAds\Enums\Common\Portfolio\PortfolioServingStatus;
use ScaleCore\AmazonAds\Enums\Common\Portfolio\PortfolioState;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class PortfolioEx extends BaseModel
{
    use JsonSerialize;

    /**
     * The portfolio identifier.
     */
    #[Json]
    public int $portfolioId;

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
    public bool $inBudget;

    /**
     * The current state of the portfolio.
     */
    #[Json]
    public PortfolioState $state;

    /**
     * Date that the portfolio was created, in epoch time.
     */
    #[Json]
    public ?PortfolioExDateTime $creationDate;

    /**
     * Date at least one property value of the portfolio was updated, in epoch time.
     */
    #[Json]
    public ?PortfolioExDateTime $lastUpdatedDate;

    /**
     * The current serving status of the portfolio.
     */
    #[Json]
    public ?PortfolioServingStatus $servingStatus;
}
