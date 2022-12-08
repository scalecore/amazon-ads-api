<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use ScaleCore\AmazonAds\Contracts\Arrayable;
use ScaleCore\AmazonAds\Contracts\Jsonable;
use ScaleCore\AmazonAds\Helpers\Cast;

/**
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @implements Arrayable<TKey, mixed>
 */
abstract class BaseRequestBody implements Arrayable, Jsonable, \JsonSerializable, \Stringable
{
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
}
