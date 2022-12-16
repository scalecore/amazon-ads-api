<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Attribution;

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
            'path'       => '/attribution/tags/macroTag',
            'httpMethod' => HttpMethod::GET,
        ],
        'getNonMacroTemplateTags' => [
            'path'       => '/attribution/tags/nonMacroTemplateTag',
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
        $responseResource = $this->getResponseResource(
            region: $region,
            requestResourceData: $this->getRequestResource(__FUNCTION__),
            profileId: $profileId,
            requestParams: new TagParams(
                [
                    'publisherIds'  => $publisherIds,
                    'advertiserIds' => $advertiserIds,
                ]
            )
        );

        if ($responseResource->hasSucceeded()) {
            return AttributionTagResponse::fromJsonData($responseResource->decodeResponseBody());
        }

        $this->throwApiResponseException(
            responseResource: $responseResource,
            apiError: ApiError::fromJsonData($responseResource->decodeResponseBody())
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
        $responseResource = $this->getResponseResource(
            region: $region,
            requestResourceData: $this->getRequestResource(__FUNCTION__),
            profileId: $profileId,
            requestParams: new TagParams(
                [
                    'publisherIds'  => $publisherIds,
                    'advertiserIds' => $advertiserIds,
                ]
            )
        );

        if ($responseResource->hasSucceeded()) {
            return AttributionTagResponse::fromJsonData(
                $responseResource->decodeResponseBody(),
                supportsMacros: false
            );
        }

        $this->throwApiResponseException(
            responseResource: $responseResource,
            apiError: ApiError::fromJsonData($responseResource->decodeResponseBody())
        );
    }
}
