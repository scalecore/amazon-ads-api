<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\RequestBodies;

use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
use ScaleCore\AmazonAds\Enums\Common\Portfolio\PortfolioState;
use ScaleCore\AmazonAds\Helpers\Cast;
use ScaleCore\AmazonAds\Helpers\Obj;
use ScaleCore\AmazonAds\Models\BaseRequestBody;
use ScaleCore\AmazonAds\Models\Common\Portfolios\Portfolio;
use ScaleCore\AmazonAds\Models\Common\Portfolios\PortfolioBudget;
use ScaleCore\AmazonAds\Models\Common\Portfolios\PortfolioList;

/**
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @template-extends BaseRequestBody<TKey, TValue>
 */
final class PortfolioCreateRequest extends BaseRequestBody implements HttpRequestBodyInterface
{
    private const MIN_PORTFOLIO_COUNT = 1;
    private const MAX_PORTFOLIO_COUNT = 100;

    public function __construct(private readonly PortfolioList $portfolios)
    {
        $this->validatePortfolios();
    }

    /**
     * Get the instance as an array.
     *
     * @return array<TKey, object>
     *
     * @throws \JsonException
     */
    public function toArray(): array
    {
        $props = [
            'name'   => null,
            'state'  => null,
            'budget' => null,
        ];

        /*
         * Optional properties for creating portfolios.
         */
        $optional = [
            'budget',
        ];

        return \array_map(
            function (Portfolio $portfolio) use ($props, $optional): object {
                $portfolioClone = Cast::fromJson($portfolio->toJson());

                /*
                 * Unset properties that are not set on the Portfolio object.
                 */
                foreach ($optional as $prop) {
                    if ( ! isset($portfolioClone->{$prop})) {
                        unset($props[$prop]);
                    }
                }

                if (isset($props['budget']) && isset($portfolio->budget)) {
                    $portfolioClone->budget = $this->transposeBudget($portfolio->budget);
                }

                return Obj::transpose((object) $props, $portfolioClone, ...\array_keys($props));
            },
            $this->portfolios->toArray()
        );
    }

    protected function transposeBudget(PortfolioBudget $budget): object
    {
        $props = [
            'amount'    => null,
            'policy'    => null,
            'startDate' => null,
            'endDate'   => null,
        ];

        /*
         * Optional properties for creating portfolio budgets.
         */
        $optional = [
            'amount',
            'endDate',
        ];

        /*
         * Unset properties that are not set on the PortfolioBudget object.
         */
        foreach ($optional as $prop) {
            if ( ! isset($budget->{$prop})) {
                unset($props[$prop]);
            }
        }

        return Obj::transpose((object) $props, $budget, ...\array_keys($props));
    }

    private function validatePortfolios(): void
    {
        $count = $this->portfolios->count();
        if ($count < self::MIN_PORTFOLIO_COUNT || $count > self::MAX_PORTFOLIO_COUNT) {
            throw new \LengthException(
                sprintf(
                    'The portfolio create operation is limited to between %s and %s portfolios, %s provided.',
                    self::MIN_PORTFOLIO_COUNT,
                    self::MAX_PORTFOLIO_COUNT,
                    $this->portfolios->count()
                )
            );
        }

        foreach ($this->portfolios->toArray() as $portfolio) {
            if ( ! isset($portfolio->state)) {
                $portfolio->state = PortfolioState::ENABLED;

                return;
            }

            if ($portfolio->state !== PortfolioState::ENABLED) {
                throw new \DomainException(
                    sprintf(
                        'The portfolio create operation only allows the `state` value to be %s, %s provided.',
                        PortfolioState::ENABLED->value,
                        $portfolio->state->value
                    )
                );
            }
        }
    }
}
