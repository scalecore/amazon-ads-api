<?php

declare(strict_types=1);

use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use ScaleCore\AmazonAds\API\Attribution\AdvertisersSDK;
use ScaleCore\AmazonAds\API\Attribution\AttributionSDK;
use ScaleCore\AmazonAds\API\Attribution\PublishersSDK;
use ScaleCore\AmazonAds\API\Attribution\ReportsSDK;
use ScaleCore\AmazonAds\API\Attribution\TagsSDK;
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
    'AttributionSDK is properly instantiated',
    function () {
        expect(
            new AttributionSDK(
                $this->client,
                $this->httpFactoryInterface,
                $this->configuration,
                $this->loggerInterface
            )
        )->toBeInstanceOf(AttributionSDK::class);
    }
);

test(
    'AttributionSDK returns PublishersSDK',
    function () {
        expect(
            (new AttributionSDK(
                $this->client,
                $this->httpFactoryInterface,
                $this->configuration,
                $this->loggerInterface
            ))->getPublishersSDK()
        )->toBeInstanceOf(PublishersSDK::class);
    }
);

test(
    'AttributionSDK returns ReportsSDK',
    function () {
        expect(
            (new AttributionSDK(
                $this->client,
                $this->httpFactoryInterface,
                $this->configuration,
                $this->loggerInterface
            ))->getReportsSDK()
        )->toBeInstanceOf(ReportsSDK::class);
    }
);

test(
    'AttributionSDK returns TagsSDK',
    function () {
        expect(
            (new AttributionSDK(
                $this->client,
                $this->httpFactoryInterface,
                $this->configuration,
                $this->loggerInterface
            ))->getTagsSDK()
        )->toBeInstanceOf(TagsSDK::class);
    }
);

test(
    'AttributionSDK returns AdvertisersSDK',
    function () {
        expect(
            (new AttributionSDK(
                $this->client,
                $this->httpFactoryInterface,
                $this->configuration,
                $this->loggerInterface
            ))->getAdvertisersSDK()
        )->toBeInstanceOf(AdvertisersSDK::class);
    }
);

test(
    'AttributionSDK returns cached SDK instance',
    function () {
        $adsSDK = (new AttributionSDK(
            $this->client,
            $this->httpFactoryInterface,
            $this->configuration,
            $this->loggerInterface
        ));

        expect($adsSDK->getAdvertisersSDK())->toBe($adsSDK->getAdvertisersSDK());
    }
);
