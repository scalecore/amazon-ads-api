<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Support;

use ScaleCore\AmazonAds\Contracts\IdGenerator;

final class UniqidGenerator implements IdGenerator
{
    public function generate(): string
    {
        return \uniqid('correlation_id_', true);
    }
}
