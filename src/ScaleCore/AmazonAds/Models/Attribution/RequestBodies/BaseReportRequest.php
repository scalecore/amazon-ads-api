<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\RequestBodies;

use ScaleCore\AmazonAds\Contracts\Arrayable;
use ScaleCore\AmazonAds\Contracts\Attribution\ReportMetricInterface;
use ScaleCore\AmazonAds\Contracts\Jsonable;
use ScaleCore\AmazonAds\Enums\Attribution\ReportType;
use ScaleCore\AmazonAds\Helpers\Cast;
use function ScaleCore\AmazonAds\Helpers\tap;

/**
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @implements Arrayable<TKey, mixed>
 */
abstract class BaseReportRequest implements Arrayable, Jsonable, \JsonSerializable, \Stringable
{
    private const MAX_COUNT = 5000;
    private const MIN_COUNT = 1;

    /**
     * @param array<array-key, int> $advertiserIds
     * @param int                   $count         [min => 1, max=> 5000]
     */
    public function __construct(
        protected readonly ReportType $reportType,
        protected readonly \DateTimeInterface $startDate,
        protected readonly \DateTimeInterface $endDate,
        protected readonly array $advertiserIds,
        protected readonly int $count = 5000,
        protected ?string $cursorId = null,
    ) {
        $this->validateCount($count);
    }

    public function setCursorId(?string $cursorId): static
    {
        $this->cursorId = $cursorId;

        return $this;
    }

    /**
     * @return array<TKey, TValue>
     */
    abstract protected function getMetrics(): array;

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return tap(
            [
                'reportType'    => $this->reportType->value,
                'advertiserIds' => \implode(',', $this->advertiserIds),
                'startDate'     => $this->startDate->format('Ymd'),
                'endDate'       => $this->endDate->format('Ymd'),
                'count'         => $this->count,
            ],
            function (array &$body): void {
                if ($this->cursorId !== null) {
                    $body['cursorId'] = $this->cursorId;
                }

                $metrics = $this->getMetrics();
                if ($metrics !== []) {
                    $body['metrics'] = \implode(
                        ',',
                        \array_map(
                            fn (ReportMetricInterface $metric): string => $metric->value(),
                            $metrics
                        )
                    );
                }
            }
        );
    }

    /**
     * @return array<TKey, TValue>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function toJson(): string
    {
        return Cast::toJson(value: $this->jsonSerialize());
    }

    /**
     * @throws \JsonException
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    protected function validateCount(int $count): void
    {
        if ($count >= self::MIN_COUNT && $count <= self::MAX_COUNT) {
            return;
        }

        throw new \OutOfRangeException(
            \sprintf(
                'Count `%d` is out of range. Must be between %d and %d.',
                $count,
                self::MIN_COUNT,
                self::MAX_COUNT
            )
        );
    }

    /**
     * @param ReportMetricInterface<TKey, TValue> $metric
     */
    protected function validateMetric(ReportMetricInterface $metric): void
    {
        if ($metric::class === $this->reportType->allowedMetricType()) {
            return;
        }

        throw new \InvalidArgumentException(
            \sprintf(
                'Invalid metric type for %s report, expecting `%s`, provided `%s`.',
                $this->reportType->value,
                $this->reportType->allowedMetricType(),
                $metric::class
            )
        );
    }
}
