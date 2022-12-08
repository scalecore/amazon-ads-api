<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Attribution;

use ScaleCore\AmazonAds\API\SubLevelSDKProvider;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;

final class AttributionSDK extends SubLevelSDKProvider implements AdsSDKInterface
{
    public function getPublishersSDK(): PublishersSDK
    {
        return $this->getSDK(PublishersSDK::class);
    }

    public function getAdvertisersSDK(): AdvertisersSDK
    {
        return $this->getSDK(AdvertisersSDK::class);
    }

    public function getTagsSDK(): TagsSDK
    {
        return $this->getSDK(TagsSDK::class);
    }

    public function getReportsSDK(): ReportsSDK
    {
        return $this->getSDK(ReportsSDK::class);
    }

    /**
     * @template T as AdsSDKInterface
     *
     * @param class-string<T> $sdkClass
     *
     * @return T
     */
    private function getSDK(string $sdkClass): AdsSDKInterface
    {
        return $this->instantiateSDK($sdkClass);
    }
}
