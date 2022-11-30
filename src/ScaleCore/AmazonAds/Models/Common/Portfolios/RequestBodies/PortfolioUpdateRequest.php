<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\RequestBodies;

use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
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
final class PortfolioUpdateRequest extends BaseRequestBody implements HttpRequestBodyInterface
{
    public function __construct(protected readonly PortfolioList $portfolios)
    {
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
        /*
         * Mutable properties.
         */
        $props = [
            'name'   => null,
            'state'  => null,
            'budget' => null,
        ];

        return \array_map(
            function (Portfolio $portfolio) use ($props): object {
                $portfolioClone = Cast::fromJson($portfolio->toJson());

                /*
                 * Unset properties that are not set on the Portfolio object.
                 */
                foreach ($props as $key => $value) {
                    if ( ! isset($portfolioClone->{$key})) {
                        unset($props[$key]);
                    }
                }
                $props['portfolioId'] = null;

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
         * Unset properties that are not set on the PortfolioBudget object.
         */
        foreach ($props as $key => $value) {
            if ( ! isset($budget->{$key})) {
                unset($props[$key]);
            }
        }

        return Obj::transpose((object) $props, $budget, ...\array_keys($props));
    }
}
