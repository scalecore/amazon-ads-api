<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts\Attribution;

/**
 * @template TKey of array-key
 * @template TValue
 */
interface ReportMetricInterface
{
    /**
     * @return array<TKey, TValue>
     */
    public static function all(): array;

    public function value(): mixed;
}
