<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts;

use ScaleCore\AmazonAds\Configuration;

interface AdsSDKInterface
{
    public function getConfiguration(): Configuration;
}
