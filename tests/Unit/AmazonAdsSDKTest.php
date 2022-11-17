<?php

declare(strict_types=1);

use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use ScaleCore\AmazonAds\AmazonAdsSDK;
use ScaleCore\AmazonAds\API\Attribution\AttributionSDK;
use ScaleCore\AmazonAds\Configuration;
use ScaleCore\AmazonAds\Contracts\HttpFactoryInterface;
use ScaleCore\AmazonAds\Contracts\HttpRequestAuthInterface;

DG\BypassFinals::enable();

beforeEach(
    function () {
        $this->client               = mock(ClientInterface::class)->expect();
        $this->httpFactoryInterface = mock(HttpFactoryInterface::class)->expect();
        $this->loggerInterface      = mock(LoggerInterface::class)->expect();
        $this->configuration        = getConfiguration(mock(HttpRequestAuthInterface::class)->expect());
    }
);

test(
    'AmazonAdsSDK is properly instantiated',
    function () {
        expect(
            new AmazonAdsSDK(
                $this->client,
                $this->httpFactoryInterface,
                $this->configuration,
                $this->loggerInterface
            )
        )->toBeInstanceOf(AmazonAdsSDK::class);
    }
);

test(
    'AmazonAdsSDK returns AttributionSDK',
    function () {
        expect(
            (new AmazonAdsSDK(
                $this->client,
                $this->httpFactoryInterface,
                $this->configuration,
                $this->loggerInterface
            ))->getAttributionSDK()
        )->toBeInstanceOf(AttributionSDK::class);
    }
);

test(
    'AmazonAdsSDK returns cached SDK instance',
    function () {
        $adsSDK = (new AmazonAdsSDK(
            $this->client,
            $this->httpFactoryInterface,
            $this->configuration,
            $this->loggerInterface
        ));

        expect($adsSDK->getAttributionSDK())->toBe($adsSDK->getAttributionSDK());
    }
);

test(
    'AmazonAdsSDK returns configuration',
    function () {
        expect(
            (new AmazonAdsSDK(
                $this->client,
                $this->httpFactoryInterface,
                $this->configuration,
                $this->loggerInterface
            ))->getConfiguration()
        )->toBeInstanceOf(Configuration::class);
    }
);
