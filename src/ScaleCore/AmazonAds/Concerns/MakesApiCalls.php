<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Concerns;

use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ScaleCore\AmazonAds\Contracts\Arrayable;
use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\MimeType;
use ScaleCore\AmazonAds\Enums\PrimitiveType;
use ScaleCore\AmazonAds\Enums\Region;
use ScaleCore\AmazonAds\Exceptions\ApiException;
use ScaleCore\AmazonAds\Exceptions\ClassNotFoundException;
use ScaleCore\AmazonAds\Helpers\Cast;
use ScaleCore\AmazonAds\Models\RequestParams;
use ScaleCore\AmazonAds\Models\RequestResourceData;
use ScaleCore\AmazonAds\Support\HttpHeaderName;

trait MakesApiCalls
{
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
     * @throws ClassNotFoundException
     */
    protected function getRequest(
        Region $region,
        RequestResourceData $requestResourceData,
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
                Cast::to(PrimitiveType::STRING, $name),
                Cast::to(PrimitiveType::STRING, $header)
            );
        }

        if ($body !== null) {
            $request = $request->withBody($this->httpFactory->createStream(Cast::to(PrimitiveType::STRING, $body)));
        }

        return $request;
    }

    /**
     * @throws ClassNotFoundException
     */
    protected function makeRequest(
        HttpMethod $httpMethod,
        string $path,
        Region $region,
        ?int $profileId = null,
        string|MimeType $accept = MimeType::JSON,
        string|MimeType $contentType = MimeType::JSON,
        ?RequestParams $requestParams = null,
        ?HttpRequestBodyInterface $body = null
    ): RequestInterface {
        $request = $this->httpFactory->createRequest(
            $httpMethod,
            $this->getApiUrl($region, $path, $requestParams)
        );

        $headers = [
            HttpHeaderName::HOST          => $region->host(),
            HttpHeaderName::AUTHORIZATION => $this->getAuthHeaderValue(),
        ];
        if ($profileId !== null) {
            $headers[HttpHeaderName::AMAZON_SCOPE] = $profileId;
        }

        $headers = [...$this->getBaseHttpHeaders(accept: $accept, contentType: $contentType), ...$headers];

        foreach ($headers as $name => $header) {
            $request = $request->withHeader(
                Cast::to(PrimitiveType::STRING, $name),
                Cast::to(PrimitiveType::STRING, $header)
            );
        }

        if ($body !== null) {
            $request = $request->withBody($this->httpFactory->createStream(Cast::to(PrimitiveType::STRING, $body)));
        }

        return $request;
    }

    /**
     * @throws ApiException
     * @throws ClassNotFoundException
     */
    protected function getResponse(RequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->httpClient->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new ApiException(
                message: "[{$e->getCode()}] {$e->getMessage()}",
                code: (int) $e->getCode(),
                previous: $e
            );
        }

        $statusCode = $response->getStatusCode();

        if ($statusCode < 200 || $statusCode > 299) {
            throw new ApiException(
                message: "[$statusCode] Error connecting to the API ({$request->getUri()})",
                code: $statusCode,
                responseHeaders: $response->getHeaders(),
                responseBody: Cast::to(PrimitiveType::STRING, $response->getBody())
            );
        }

        return $response;
    }

    /**
     * @throws \JsonException
     * @throws ClassNotFoundException
     */
    protected function decodeResponseBody(ResponseInterface $response): mixed
    {
        return match (MimeType::tryFrom($response->getHeader(HttpHeaderName::CONTENT_TYPE)[0] ?? '')) {
            MimeType::JSON,
            MimeType::OCTET_STREAM => Cast::fromJson(
                json: Cast::to(PrimitiveType::STRING, $response->getBody()),
                associative: true
            ),
            MimeType::TEXT_PLAIN => Cast::to(PrimitiveType::STRING, $response->getBody()),
            default              => $response->getBody(),
        };
    }

    /**
     * @param array<string, string> $pathReplacements
     */
    protected function getRequestResourceData(array $pathReplacements = []): RequestResourceData
    {
        return RequestResourceData::for(
            class: get_class($this),
            function: debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'],
            pathReplacements: $pathReplacements
        );
    }
}
