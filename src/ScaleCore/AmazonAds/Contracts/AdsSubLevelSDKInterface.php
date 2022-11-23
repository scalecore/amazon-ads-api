<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts;

use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\MimeType;

interface AdsSubLevelSDKInterface
{
    public function getRequestResourceDataPath(string $operation): string;

    public function getRequestResourceDataHttpMethod(string $operation): HttpMethod;

    public function getRequestResourceDataAcceptHeader(string $operation): string|MimeType;

    public function getRequestResourceDataContentTypeHeader(string $operation): string|MimeType;
}
