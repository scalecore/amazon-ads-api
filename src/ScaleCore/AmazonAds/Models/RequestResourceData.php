<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\MimeType;
use ScaleCore\AmazonAds\Helpers\Arr;

final class RequestResourceData
{
    private function __construct(
        public readonly string $path,
        public readonly HttpMethod $httpMethod,
        public readonly string|MimeType $accept = MimeType::JSON,
        public readonly string|MimeType $contentType = MimeType::JSON
    ) {
    }

    /**
     * @param array<string, string> $pathReplacements
     */
    public static function for(string $class, string $function, array $pathReplacements = []): self
    {
        $data = Arr::get($class::RESOURCE_DATA ?? [], $function)
            ?? throw new \UnexpectedValueException(
                \sprintf(
                    'Missing request resource data for `%s::%s` SDK method.',
                    $class,
                    $function
                )
            );

        $path = $data['path']
            ?? throw new \UnexpectedValueException(
                \sprintf(
                    'Missing request resource data `path` value for `%s::%s` SDK method.',
                    $class,
                    $function
                )
            );

        $httpMethod = $data['httpMethod']
            ?? throw new \UnexpectedValueException(
                \sprintf(
                    'Missing request resource data `httpMethod` value for `%s::%s` SDK method.',
                    $class,
                    $function
                )
            );

        return new self(
            path: self::replacePathParams($path, $pathReplacements),
            httpMethod: $httpMethod,
            accept: $data['accept'] ?? MimeType::JSON,
            contentType: $data['contentType'] ?? MimeType::JSON
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
