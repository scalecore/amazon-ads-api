<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\RequestBodies;

use ScaleCore\AmazonAds\Contracts\Attribution\ReportMetricInterface;
use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
use ScaleCore\AmazonAds\Enums\Attribution\PerformanceReportGroupBy;
use ScaleCore\AmazonAds\Enums\Attribution\PerformanceReportMetric;
use ScaleCore\AmazonAds\Enums\Attribution\ReportType;

/**
 * @template TKey of array-key
 * @template TValue of \ScaleCore\AmazonAds\Enums\Attribution\PerformanceReportMetric
 *
 * @extends BaseReportRequest<TKey, TValue>
 */
final class PerformanceReportRequest extends BaseReportRequest implements HttpRequestBodyInterface
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
        protected readonly PerformanceReportGroupBy $groupBy = PerformanceReportGroupBy::CREATIVE
    ) {
        parent::__construct(
            ReportType::PERFORMANCE,
            $startDate,
            $endDate,
            $advertiserIds,
            $count,
            $cursorId
        );

        \array_walk($metrics, [$this, 'validatePerformanceReportMetric']);
    }

    /**
     * @return array<TKey, TValue>
     */
    protected function getMetrics(): array
    {
        return $this->metrics;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return [
            ...parent::toArray(),
            'groupBy' => $this->groupBy->value,
        ];
    }

    private function validatePerformanceReportMetric(PerformanceReportMetric $metric): void
    {
        /** @var ReportMetricInterface<TKey, TValue> $metric */
        parent::validateMetric($metric);

        /** @var PerformanceReportMetric $metric */
        if (
            $metric === PerformanceReportMetric::BRB_BONUS_AMOUNT
            && $this->groupBy === PerformanceReportGroupBy::CREATIVE
        ) {
            throw new \InvalidArgumentException(
                \sprintf(
                    'Provided GroupBy `%s` is not supported by Metric `%s`.',
                    $this->groupBy->value,
                    $metric->value
                )
            );
        }
    }
}
