<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Attribution;

use ScaleCore\AmazonAds\API\SubLevelSDK;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\Region;
use ScaleCore\AmazonAds\Exceptions\ApiException;
use ScaleCore\AmazonAds\Exceptions\ClassNotFoundException;
use ScaleCore\AmazonAds\Models\Attribution\RequestParams\TagParams;
use ScaleCore\AmazonAds\Models\Attribution\Responses\AttributionTagResponse;

final class TagsSDK extends SubLevelSDK implements AdsSDKInterface
{
    public const RESOURCE_DATA = [
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
     * @throws ClassNotFoundException
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
                        requestResourceData: $this->getRequestResourceData(),
                        profileId: $profileId,
                        requestParams: new TagParams(
                            [
                                'publisherIds'  => $publisherIds,
                                'advertiserIds' => $advertiserIds,
                            ]
                        )
                    )
                )
            )
        );
    }

    /**
     * @param array<array-key, int> $publisherIds
     * @param array<array-key, int> $advertiserIds
     *
     * @throws ApiException
     * @throws ClassNotFoundException
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
                        requestResourceData: $this->getRequestResourceData(),
                        profileId: $profileId,
                        requestParams: new TagParams(
                            [
                                'publisherIds'  => $publisherIds,
                                'advertiserIds' => $advertiserIds,
                            ]
                        )
                    )
                )
            ),
            supportsMacros: false
        );
    }
}
