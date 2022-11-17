<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds;

use ScaleCore\AmazonAds\API\Attribution\AttributionSDK;
use ScaleCore\AmazonAds\API\BaseSDK;
use ScaleCore\AmazonAds\Concerns\ProvidesSubLevelSDK;

final class AmazonAdsSDK extends BaseSDK
{
    use ProvidesSubLevelSDK;

    public function getAttributionSDK(): AttributionSDK
    {
        return $this->instantiateSDK(AttributionSDK::class);
    }
}
