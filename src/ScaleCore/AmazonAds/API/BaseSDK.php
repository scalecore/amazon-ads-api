<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API;

use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use ScaleCore\AmazonAds\Configuration;
use ScaleCore\AmazonAds\Contracts\HttpFactoryInterface;

abstract class BaseSDK
{
    public function __construct(
        protected readonly ClientInterface $httpClient,
        protected readonly HttpFactoryInterface $httpFactory,
        protected readonly Configuration $configuration,
        protected readonly LoggerInterface $logger
    ) {
    }

    public function getConfiguration(): Configuration
    {
        return $this->configuration;
    }
}
