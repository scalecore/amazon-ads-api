<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Concerns;

/**
 * @template TKey of array-key
 * @template TValue
 */
trait GetsAllEnumCases
{
    /**
     * @return array<TKey, TValue>
     */
    public static function all(): array
    {
        return self::cases();
    }
}
