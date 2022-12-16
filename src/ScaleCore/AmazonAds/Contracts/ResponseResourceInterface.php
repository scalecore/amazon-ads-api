<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ResponseResourceInterface
{
    public static function for(RequestInterface $request, ResponseInterface $response): self;

    public function getRequest(): RequestInterface;

    public function getResponse(): ResponseInterface;

    public function hasSucceeded(): bool;

    public function hasFailed(): bool;

    public function getResponseStatusCode(): int;

    public function decodeResponseBody(): mixed;
}
