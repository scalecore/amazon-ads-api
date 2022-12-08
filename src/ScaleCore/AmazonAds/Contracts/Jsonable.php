<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts;

interface Jsonable
{
    /**
     * Convert the object to its JSON representation.
     *
     * @throws \JsonException
     */
    public function toJson(): string;
}
