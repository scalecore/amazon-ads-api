<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ScaleCore\AmazonAds\Contracts\AdsSubLevelSDKInterface;
use ScaleCore\AmazonAds\Contracts\ApiErrorInterface;
use ScaleCore\AmazonAds\Contracts\Arrayable;
use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\MimeType;
use ScaleCore\AmazonAds\Enums\Region;
use ScaleCore\AmazonAds\Exceptions\ApiException;
use ScaleCore\AmazonAds\Helpers\Arr;
use ScaleCore\AmazonAds\Helpers\Cast;
use ScaleCore\AmazonAds\Models\Errors\AccessDeniedError;
use ScaleCore\AmazonAds\Models\Errors\ApiError;
use ScaleCore\AmazonAds\Models\Errors\ApiThrottlingError;
use ScaleCore\AmazonAds\Models\Errors\InternalServerError;
use ScaleCore\AmazonAds\Models\Errors\UnauthorizedError;
use ScaleCore\AmazonAds\Models\Errors\UnsupportedMediaTypeError;
use ScaleCore\AmazonAds\Models\RequestParams;
use ScaleCore\AmazonAds\Models\RequestResource;
use ScaleCore\AmazonAds\Models\ResponseResource;
use ScaleCore\AmazonAds\Support\HttpHeaderName;
use ScaleCore\AmazonAds\Support\HttpResponseStatusCode as Http;

abstract class SubLevelSDK extends BaseSDK implements AdsSubLevelSDKInterface
{
    /**
     * @throws \UnexpectedValueException
     */
    public function getRequestResourceDataPath(string $operation): string
    {
        $path = $this->getRequestResourceData($operation, 'path');

        if (is_string($path)) {
            return $path;
        }

        throw new \UnexpectedValueException(
            \sprintf(
                'Missing or invalid request resource data `path` value for `%s::%s` SDK operation.',
                $this::class,
                $operation
            )
        );
    }

    /**
     * @throws \UnexpectedValueException
     */
    public function getRequestResourceDataHttpMethod(string $operation): HttpMethod
    {
        $httpMethod = $this->getRequestResourceData($operation, 'httpMethod');

        if ($httpMethod instanceof HttpMethod) {
            return $httpMethod;
        }

        throw new \UnexpectedValueException(
            \sprintf(
                'Missing or invalid request resource data `httpMethod` value for `%s::%s` SDK operation.',
                $this::class,
                $operation
            )
        );
    }

    public function getRequestResourceDataAcceptHeader(string $operation): string|MimeType
    {
        $accept = $this->getRequestResourceData($operation, 'accept');

        if (\is_string($accept) || $accept instanceof MimeType) {
            return $accept;
        }

        if ($accept === null) {
            return MimeType::JSON;
        }

        throw new \UnexpectedValueException(
            \sprintf(
                'Invalid request resource data `accept` value for `%s::%s` SDK operation.'
                . ' Must be null|string|MimeType, %s provided.',
                $this::class,
                $operation,
                \gettype($accept)
            )
        );
    }

    public function getRequestResourceDataContentTypeHeader(string $operation): string|MimeType
    {
        $contentType = $this->getRequestResourceData($operation, 'contentType');

        if (\is_string($contentType) || $contentType instanceof MimeType) {
            return $contentType;
        }

        if ($contentType === null) {
            return MimeType::JSON;
        }

        throw new \UnexpectedValueException(
            \sprintf(
                'Invalid request resource data `contentType` value for `%s::%s` SDK operation.'
                . ' Must be null|string|MimeType, %s provided.',
                $this::class,
                $operation,
                \gettype($contentType)
            )
        );
    }

    protected function getRequestResourceData(string $operation, string $dataPoint): string|HttpMethod|MimeType|null
    {
        return Arr::get($this->resourceData ?? [], $operation . '.' . $dataPoint);
    }

    /**
     * @param array<string, string> $pathReplacements
     */
    protected function getRequestResource(string $operation, array $pathReplacements = []): RequestResource
    {
        return RequestResource::for(
            sdk: $this,
            operation: $operation,
            pathReplacements: $pathReplacements
        );
    }

    /**
     * @return array<string, string>
     */
    protected function getBaseHttpHeaders(string|MimeType $accept, string|MimeType $contentType): array
    {
        return [
            HttpHeaderName::CONTENT_TYPE     => $contentType instanceof MimeType ? $contentType->value : $contentType,
            HttpHeaderName::ACCEPT           => $accept instanceof MimeType ? $accept->value : $accept,
            HttpHeaderName::USER_AGENT       => $this->configuration->getUserAgent(),
            HttpHeaderName::AMAZON_CLIENT_ID => $this->configuration->getLwaClientID(),
        ];
    }

    protected function getAuthHeaderValue(): string
    {
        $auth = $this->configuration->getHttpRequestAuth();

        return $auth->getAuthType() . ' ' . ($auth->getAuthData() ?? '');
    }

    /**
     * Return the API url to call with request params added.
     *
     * @param Arrayable<string, mixed>|null $params
     */
    protected function getApiUrl(Region $region, string $fragment = '', ?Arrayable $params = null): string
    {
        $url = $region->url() . $fragment;

        return $params instanceof Arrayable ? $url . '?' . \http_build_query($params->toArray()) : $url;
    }

    /**
     * @throws ApiException
     */
    protected function getResponseResource(
        Region $region,
        RequestResource $requestResourceData,
        ?int $profileId = null,
        ?RequestParams $requestParams = null,
        ?HttpRequestBodyInterface $body = null
    ): ResponseResource {
        $correlationId = $this->configuration->getIdGenerator()->generate();

        $request = $this->getRequest(
            region: $region,
            requestResourceData: $requestResourceData,
            profileId: $profileId,
            requestParams: $requestParams,
            body: $body
        );

        $response = $this->getResponse(
            request: $request,
            operation: $requestResourceData->operation,
            correlationId: $correlationId,
        );

        return ResponseResource::for(
            request: $request,
            response: $response,
            correlationId: $correlationId,
        );
    }

    /**
     * @throws ApiException
     * @throws \JsonException
     */
    protected function throwApiResponseException(
        ResponseResource $responseResource,
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
        ?ApiErrorInterface $apiError = null
    ): never {
        throw new ApiException(
            message: $message,
            code: $code,
            previous: $previous,
            request: $responseResource->getRequest(),
            response: $responseResource->getResponse(),
            apiError: $apiError ?? $this->getApiError($responseResource),
            correlationId: $responseResource->getCorrelationId(),
        );
    }

    /**
     * @throws \JsonException
     */
    protected function getApiError(ResponseResource $responseResource): ApiErrorInterface
    {
        return match ($responseResource->getResponseStatusCode()) {
            Http::UNAUTHORIZED           => UnauthorizedError::fromJsonData($responseResource->decodeResponseBody()),
            Http::FORBIDDEN              => AccessDeniedError::fromJsonData($responseResource->decodeResponseBody()),
            Http::UNSUPPORTED_MEDIA_TYPE => UnsupportedMediaTypeError::fromJsonData($responseResource->decodeResponseBody()),
            Http::TOO_MANY_REQUESTS      => ApiThrottlingError::fromJsonData($responseResource->decodeResponseBody())
                                                              ->setRetryAfter(
                                                                  Cast::toInt(
                                                                      $responseResource
                                                                          ->getResponse()
                                                                          ->getHeader(HttpHeaderName::RETRY_AFTER)[0] ?? 0
                                                                  )
                                                              ),
            Http::INTERNAL_SERVER_ERROR => InternalServerError::fromJsonData($responseResource->decodeResponseBody()),
            default                     => ApiError::fromJsonData($responseResource->decodeResponseBody()),
        };
    }

    private function getRequest(
        Region $region,
        RequestResource $requestResourceData,
        ?int $profileId = null,
        ?RequestParams $requestParams = null,
        ?HttpRequestBodyInterface $body = null
    ): RequestInterface {
        $request = $this->httpFactory->createRequest(
            $requestResourceData->httpMethod,
            $this->getApiUrl($region, $requestResourceData->path, $requestParams)
        );

        $headers = [
            HttpHeaderName::HOST          => $region->host(),
            HttpHeaderName::AUTHORIZATION => $this->getAuthHeaderValue(),
        ];
        if ($profileId !== null) {
            $headers[HttpHeaderName::AMAZON_SCOPE] = $profileId;
        }

        $headers = [
            ...$this->getBaseHttpHeaders(
                accept: $requestResourceData->accept,
                contentType: $requestResourceData->contentType
            ),
            ...$headers,
        ];

        foreach ($headers as $name => $header) {
            $request = $request->withHeader(
                Cast::toString($name),
                Cast::toString($header)
            );
        }

        if ($body !== null) {
            $request = $request->withBody($this->httpFactory->createStream(Cast::toString($body)));
        }

        return $request;
    }

    /**
     * @throws ApiException
     */
    private function getResponse(
        RequestInterface $request,
        string $operation,
        string $correlationId,
    ): ResponseInterface {
        try {
            $loggingEnabled = $this->configuration->loggingEnabled($this::class, $operation);
            $logLevel       = $this->configuration->getLogLevel($this::class, $operation);

            if ($loggingEnabled) {
                $sanitizedRequest = $request;

                foreach ($this->configuration->loggingSkipHeaders() as $sensitiveHeader) {
                    $sanitizedRequest = $sanitizedRequest->withoutHeader($sensitiveHeader);
                }

                $this->logger->log(
                    $logLevel->label(),
                    'Amazon Ads API pre request',
                    [
                        'api'                    => $this::class,
                        'operation'              => $operation,
                        'request_correlation_id' => $correlationId,
                        'request_body'           => Cast::toString($sanitizedRequest->getBody()),
                        'request_headers'        => $sanitizedRequest->getHeaders(),
                        'request_uri'            => Cast::toString($sanitizedRequest->getUri()),
                    ]
                );
            }

            $response = $this->httpClient->sendRequest($request);

            if ($loggingEnabled) {
                $sanitizedResponse = $response;

                foreach ($this->configuration->loggingSkipHeaders() as $sensitiveHeader) {
                    $sanitizedResponse = $sanitizedResponse->withoutHeader($sensitiveHeader);
                }

                $this->logger->log(
                    $logLevel->label(),
                    'Amazon Ads API post request',
                    [
                        'api'                     => $this::class,
                        'operation'               => $operation,
                        'response_correlation_id' => $correlationId,
                        'response_body'           => Cast::toString($sanitizedResponse->getBody()),
                        'response_headers'        => $sanitizedResponse->getHeaders(),
                        'response_status_code'    => $sanitizedResponse->getStatusCode(),
                    ]
                );
            }
        } catch (ClientExceptionInterface $e) {
            throw new ApiException(
                message: "[{$e->getCode()}] {$e->getMessage()}",
                code: Cast::toInt($e->getCode()),
                previous: $e,
                request: $request,
                correlationId: $correlationId,
            );
        }

        return $response;
    }
}
