<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Concerns;

use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;
use function ScaleCore\AmazonAds\Helpers\tap;

trait ProvidesSubLevelSDK
{
    /**
     * @var array<class-string<AdsSDKInterface>, AdsSDKInterface>
     */
    protected array $instances = [];

    /**
     * @template T as AdsSDKInterface
     *
     * @param class-string<T> $sdkClass
     *
     * @return T
     */
    protected function instantiateSDK(string $sdkClass): AdsSDKInterface
    {
        if (isset($this->instances[$sdkClass])) {
            /** @var T $inst */
            $inst = $this->instances[$sdkClass];

            return $inst;
        }

        return tap(
            new $sdkClass(
                $this->httpClient,
                $this->httpFactory,
                $this->configuration,
                $this->logger,
            ),
            function (AdsSDKInterface $sdk) use ($sdkClass): void {
                $this->instances[$sdkClass] = $sdk;
            }
        );
    }
}
