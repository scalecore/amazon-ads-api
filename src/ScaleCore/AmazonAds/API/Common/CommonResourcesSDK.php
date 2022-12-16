<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Common;

use ScaleCore\AmazonAds\API\Common\AdvertisingAccounts\AdvertisingAccountsSDK;
use ScaleCore\AmazonAds\API\Common\Portfolios\PortfoliosSDK;
use ScaleCore\AmazonAds\API\SubLevelSDKProvider;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;

final class CommonResourcesSDK extends SubLevelSDKProvider implements AdsSDKInterface
{
    public function getPortfoliosSDK(): PortfoliosSDK
    {
        return $this->getSDK(PortfoliosSDK::class);
    }

    public function getAdvertisingAccountsSDK(): AdvertisingAccountsSDK
    {
        return $this->getSDK(AdvertisingAccountsSDK::class);
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
