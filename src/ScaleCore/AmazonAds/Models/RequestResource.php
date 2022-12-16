<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use ScaleCore\AmazonAds\Contracts\AdsSubLevelSDKInterface;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\MimeType;

final class RequestResource
{
    private function __construct(
        public readonly string $operation,
        public readonly string $path,
        public readonly HttpMethod $httpMethod,
        public readonly string|MimeType $accept,
        public readonly string|MimeType $contentType
    ) {
    }

    /**
     * @param array<string, string> $pathReplacements
     */
    public static function for(AdsSubLevelSDKInterface $sdk, string $operation, array $pathReplacements = []): self
    {
        return new self(
            operation: $operation,
            path: self::replacePathParams($sdk->getRequestResourceDataPath($operation), $pathReplacements),
            httpMethod: $sdk->getRequestResourceDataHttpMethod($operation),
            accept: $sdk->getRequestResourceDataAcceptHeader($operation),
            contentType: $sdk->getRequestResourceDataContentTypeHeader($operation)
        );
    }

    /**
     * @param array<string, string> $pathReplacements
     */
    private static function replacePathParams(string $path, array $pathReplacements): string
    {
        if ($pathReplacements === []) {
            return $path;
        }

        return \str_replace(\array_keys($pathReplacements), \array_values($pathReplacements), $path);
    }
}
