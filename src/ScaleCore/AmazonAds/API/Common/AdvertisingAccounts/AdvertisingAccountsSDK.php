<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Common\AdvertisingAccounts;

use ScaleCore\AmazonAds\API\SubLevelSDKProvider;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;

final class AdvertisingAccountsSDK extends SubLevelSDKProvider implements AdsSDKInterface
{
    public function getProfilesSDK(): ProfilesSDK
    {
        return $this->getSDK(ProfilesSDK::class);
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
