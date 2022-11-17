<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Concerns;

trait GetsEnumValue
{
    public function value(): mixed
    {
        return $this->value;
    }
}
