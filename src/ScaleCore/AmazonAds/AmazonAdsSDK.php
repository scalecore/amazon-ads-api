<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds;

use ScaleCore\AmazonAds\API\Attribution\AttributionSDK;
use ScaleCore\AmazonAds\API\Common\CommonResourcesSDK;
use ScaleCore\AmazonAds\API\SubLevelSDKProvider;

final class AmazonAdsSDK extends SubLevelSDKProvider
{
    public function getAttributionSDK(): AttributionSDK
    {
        return $this->instantiateSDK(AttributionSDK::class);
    }

    public function getCommonResourcesSDK(): CommonResourcesSDK
    {
        return $this->instantiateSDK(CommonResourcesSDK::class);
    }
}
