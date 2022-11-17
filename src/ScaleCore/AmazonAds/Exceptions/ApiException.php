<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Exceptions;

final class ApiException extends \Exception
{
    /**
     * @param array<string, array<array-key, string>>|null $responseHeaders
     */
    public function __construct(
        string $message = '',
        int $code = 0,
        protected ?array $responseHeaders = null,
        protected object|string|null $responseBody = null,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Gets the HTTP response headers.
     *
     * @return array<string, array<array-key, string>>|null
     */
    public function getResponseHeaders(): ?array
    {
        return $this->responseHeaders;
    }

    /**
     * Gets the HTTP body of the server response either as Json or string.
     */
    public function getResponseBody(): object|string|null
    {
        return $this->responseBody;
    }
}
