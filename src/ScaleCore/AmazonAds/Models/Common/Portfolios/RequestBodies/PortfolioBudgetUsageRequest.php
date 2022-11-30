<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\RequestBodies;

use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
use ScaleCore\AmazonAds\Models\BaseRequestBody;

/**
 * @template TKey of array-key
 * @template TValue of string
 *
 * @template-extends BaseRequestBody<TKey, TValue>
 */
final class PortfolioBudgetUsageRequest extends BaseRequestBody implements HttpRequestBodyInterface
{
    private const MIN_PORTFOLIO_COUNT = 1;
    private const MAX_PORTFOLIO_COUNT = 100;

    /**
     * @param array<TKey, TValue> $portfolioIds
     */
    public function __construct(private readonly array $portfolioIds)
    {
        $count = count($this->portfolioIds);
        if ($count < self::MIN_PORTFOLIO_COUNT || $count > self::MAX_PORTFOLIO_COUNT) {
            throw new \LengthException(
                sprintf(
                    'The portfolio budget usage request operation is limited to between %s and %s portfolioIds, %s provided.',
                    self::MIN_PORTFOLIO_COUNT,
                    self::MAX_PORTFOLIO_COUNT,
                    $count
                )
            );
        }

        foreach ($this->portfolioIds as $portfolioId) {
            if ( ! \is_string($portfolioId)) {
                throw new \DomainException(
                    sprintf(
                        'The portfolio budget usage request operation only allows string portfolioId values, %s provided.',
                        gettype($portfolioId)
                    )
                );
            }
        }
    }

    /**
     * Get the instance as an array.
     *
     * @return array<TKey, TValue>
     */
    public function toArray(): array
    {
        return $this->portfolioIds;
    }
}
