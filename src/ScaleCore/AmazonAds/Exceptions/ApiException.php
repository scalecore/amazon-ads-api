<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ScaleCore\AmazonAds\Contracts\ApiErrorInterface;
use ScaleCore\AmazonAds\Helpers\Cast;

class ApiException extends \Exception
{
    public function __construct(
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
        protected readonly ?RequestInterface $request = null,
        protected readonly ?ResponseInterface $response = null,
        protected readonly ?ApiErrorInterface $apiError = null
    ) {
        $code    = $this->initCode($code);
        $message = $this->initMessage($message, $code);

        parent::__construct($message, $code, $previous);
    }

    /**
     * Returns the HTTP server request for the API call.
     */
    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    /**
     * Returns the HTTP server response for the API call.
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * Returns the HTTP server response for the API call.
     */
    public function getApiError(): ?ApiErrorInterface
    {
        return $this->apiError;
    }

    protected function initCode(int $code): int
    {
        if ($code !== 0) {
            return $code;
        }

        return Cast::toInt($this->apiError?->getCode() ?? $this->response?->getStatusCode() ?? $code);
    }

    protected function initMessage(string $message, int $code): string
    {
        if ($message !== '') {
            return $message;
        }

        $subMessage = $this->apiError?->getDetails() ?? $this->response?->getReasonPhrase();

        return sprintf(
            '[%s] %s (%s)',
            $code,
            empty($subMessage) ? 'Error connecting to the API' : $subMessage,
            $this->request?->getUri() ?? ''
        );
    }
}
