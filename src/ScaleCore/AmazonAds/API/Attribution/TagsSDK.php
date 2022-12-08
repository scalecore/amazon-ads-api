<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Attribution;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use ScaleCore\AmazonAds\API\SubLevelSDK;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\Region;
use ScaleCore\AmazonAds\Exceptions\ApiException;
use ScaleCore\AmazonAds\Models\ApiError;
use ScaleCore\AmazonAds\Models\Attribution\RequestParams\TagParams;
use ScaleCore\AmazonAds\Models\Attribution\Responses\AttributionTagResponse;

final class TagsSDK extends SubLevelSDK implements AdsSDKInterface
{
    /** @var array<string, array<string, mixed>> */
    protected array $resourceData = [
        'getMacroTemplateTags' => [
            'path'       => '/attribution/tags/macroTag/',
            'httpMethod' => HttpMethod::GET,
        ],
        'getNonMacroTemplateTags' => [
            'path'       => '/attribution/tags/nonMacroTemplateTag/',
            'httpMethod' => HttpMethod::GET,
        ],
    ];

    /**
     * @param array<array-key, int> $publisherIds
     * @param array<array-key, int> $advertiserIds
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function getMacroTemplateTags(
        Region $region,
        int $profileId,
        array $publisherIds,
        array $advertiserIds = []
    ): AttributionTagResponse {
        return AttributionTagResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        profileId: $profileId,
                        requestParams: new TagParams(
                            [
                                'publisherIds'  => $publisherIds,
                                'advertiserIds' => $advertiserIds,
                            ]
                        )
                    ),
                    __FUNCTION__
                )
            )
        );
    }

    /**
     * @param array<array-key, int> $publisherIds
     * @param array<array-key, int> $advertiserIds
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function getNonMacroTemplateTags(
        Region $region,
        int $profileId,
        array $publisherIds,
        array $advertiserIds = []
    ): AttributionTagResponse {
        return AttributionTagResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        profileId: $profileId,
                        requestParams: new TagParams(
                            [
                                'publisherIds'  => $publisherIds,
                                'advertiserIds' => $advertiserIds,
                            ]
                        )
                    ),
                    __FUNCTION__
                )
            ),
            supportsMacros: false
        );
    }

    /**
     * @throws ApiException
     * @throws \JsonException
     */
    protected function throwApiException(
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null,
        ?RequestInterface $request = null,
        ?ResponseInterface $response = null
    ): never {
        throw new ApiException(
            message: $message,
            code: $code,
            previous: $previous,
            request: $request,
            response: $response,
            apiError: $response === null ? null : ApiError::fromJsonData($this->decodeResponseBody($response))
        );
    }
}
