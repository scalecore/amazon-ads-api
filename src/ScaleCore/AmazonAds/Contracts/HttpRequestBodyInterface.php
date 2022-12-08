<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts;

interface HttpRequestBodyInterface
{
    public function __toString(): string;
}
