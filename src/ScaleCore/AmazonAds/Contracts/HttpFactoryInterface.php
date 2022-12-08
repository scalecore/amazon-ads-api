<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use ScaleCore\AmazonAds\Enums\HttpMethod;

interface HttpFactoryInterface
{
    public function createRequest(HttpMethod $method, UriInterface|string $url): RequestInterface;

    public function createStream(string $content): StreamInterface;
}
