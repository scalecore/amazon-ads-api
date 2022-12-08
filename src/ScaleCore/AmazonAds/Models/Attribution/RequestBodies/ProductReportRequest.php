<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\RequestBodies;

use ScaleCore\AmazonAds\Contracts\Attribution\ReportMetricInterface;
use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
use ScaleCore\AmazonAds\Enums\Attribution\ReportType;

/**
 * @template TKey of array-key
 * @template TValue of \ScaleCore\AmazonAds\Enums\Attribution\ProductReportMetric
 *
 * @extends BaseReportRequest<TKey, TValue>
 */
final class ProductReportRequest extends BaseReportRequest implements HttpRequestBodyInterface
{
    /**
     * @param array<array-key, int>    $advertiserIds
     * @param array<array-key, TValue> $metrics
     * @param int                      $count         [min => 1, max=> 5000]
     */
    public function __construct(
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        array $advertiserIds,
        protected readonly array $metrics = [],
        int $count = 5000,
        ?string $cursorId = null,
    ) {
        parent::__construct(
            ReportType::PRODUCTS,
            $startDate,
            $endDate,
            $advertiserIds,
            $count,
            $cursorId
        );

        /** @var ReportMetricInterface<TKey, TValue> $metrics */
        \array_walk($metrics, $this->validateMetric(...));
    }

    /**
     * @return array<TKey, TValue>
     */
    protected function getMetrics(): array
    {
        return $this->metrics;
    }
}
