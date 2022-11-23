<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Attribution;

use ScaleCore\AmazonAds\API\SubLevelSDK;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\Region;
use ScaleCore\AmazonAds\Exceptions\ApiException;
use ScaleCore\AmazonAds\Models\Attribution\Responses\AdvertisersResponse;

final class AdvertisersSDK extends SubLevelSDK implements AdsSDKInterface
{
    /** @var array<string, array<string, mixed>> */
    protected array $resourceData = [
        'getAdvertisers' => [
            'path'       => '/attribution/advertisers/',
            'httpMethod' => HttpMethod::GET,
        ],
    ];

    /**
     * @throws ApiException
     * @throws \JsonException
     */
    public function getAdvertisers(Region $region, int $profileId): AdvertisersResponse
    {
        return AdvertisersResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        profileId: $profileId
                    ),
                    __FUNCTION__
                )
            )
        );
    }
}
