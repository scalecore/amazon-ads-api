<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts;

interface IdGenerator
{
    public function generate(): string;
}
