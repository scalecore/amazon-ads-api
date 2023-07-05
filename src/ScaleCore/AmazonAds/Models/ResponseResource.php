<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ScaleCore\AmazonAds\Enums\MimeType;
use ScaleCore\AmazonAds\Helpers\Cast;
use ScaleCore\AmazonAds\Support\HttpHeaderName;

final class ResponseResource
{
    public function __construct(
        private readonly RequestInterface $request,
        private readonly ResponseInterface $response,
        private readonly string $correlationId,
    ) {
    }

    public static function for(
        RequestInterface $request,
        ResponseInterface $response,
        string $correlationId
    ): self {
        return new self($request, $response, $correlationId);
    }

    /**
     * Identifier used to tie API call logging together.
     */
    public function getCorrelationId(): string
    {
        return $this->correlationId;
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getResponseStatusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function hasSucceeded(): bool
    {
        $statusCode = $this->getResponseStatusCode();

        return $statusCode >= 200 && $statusCode < 300;
    }

    /**
     * @throws \JsonException
     */
    public function decodeResponseBody(): mixed
    {
        return match (Cast::toMimeType($this->response->getHeader(HttpHeaderName::CONTENT_TYPE)[0] ?? '')) {
            MimeType::JSON,
            MimeType::OCTET_STREAM => Cast::fromJson(
                json: Cast::toString($this->response->getBody()),
                associative: true
            ),
            MimeType::TEXT_PLAIN => Cast::toString($this->response->getBody()),
            default              => $this->response->getBody(),
        };
    }
}
