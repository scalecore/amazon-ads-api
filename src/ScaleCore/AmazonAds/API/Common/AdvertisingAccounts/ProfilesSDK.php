<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Common\AdvertisingAccounts;

use ScaleCore\AmazonAds\API\SubLevelSDK;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;
use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles\AccessLevel;
use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles\AccountType;
use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles\ApiProgram;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\Region;
use ScaleCore\AmazonAds\Exceptions\ApiException;
use ScaleCore\AmazonAds\Helpers\Cast;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\Profile;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\ProfileList;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\RequestBodies\ProfilesDailyBudgetUpdateRequest;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\RequestParams\GetProfilesParams;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\Responses\GetProfilesResponse;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\Responses\ProfilesDailyBudgetUpdateResponse;

final class ProfilesSDK extends SubLevelSDK implements AdsSDKInterface
{
    /** @var array<string, array<string, mixed>> */
    protected array $resourceData = [
        'getProfiles' => [
            'path'       => '/v2/profiles/',
            'httpMethod' => HttpMethod::GET,
        ],
        'getProfile' => [
            'path'       => '/v2/profiles/{profileId}/',
            'httpMethod' => HttpMethod::GET,
        ],
        'updateProfilesDailyBudget' => [
            'path'       => '/v2/profiles/',
            'httpMethod' => HttpMethod::PUT,
        ],
    ];

    /**
     * Gets a list of Profiles.
     *
     * This operation does not return a response unless the current account
     * has created at least one campaign using the advertising console.
     *
     * @throws \JsonException
     * @throws ApiException
     */
    public function getProfiles(
        Region $region,
        ?ApiProgram $apiProgram = null,
        ?AccessLevel $accessLevel = null,
        ?AccountType $profileTypeFilter = null,
        ?bool $validPaymentMethodFilter = null
    ): GetProfilesResponse {
        return GetProfilesResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        requestParams: new GetProfilesParams(
                            [
                                'apiProgram'               => $apiProgram,
                                'accessLevel'              => $accessLevel,
                                'profileTypeFilter'        => $profileTypeFilter,
                                'validPaymentMethodFilter' => $validPaymentMethodFilter,
                            ]
                        )
                    ),
                    __FUNCTION__
                )
            )
        );
    }

    /**
     * Gets a Profile specified by identifier.
     *
     * This operation does not return a response unless the current account
     * has created at least one campaign using the advertising console.
     *
     * @throws \JsonException
     * @throws ApiException
     */
    public function getProfile(
        Region $region,
        int $profileId
    ): Profile {
        return Profile::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(
                            __FUNCTION__,
                            ['{profileId}' => Cast::toString($profileId)]
                        )
                    ),
                    __FUNCTION__
                )
            )
        );
    }

    /**
     * Update the daily budget for one or more profiles.
     *
     * Note that this operation is only used for Sellers using Sponsored Products.
     * This operation is not enabled for vendor type accounts.
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function updateProfilesDailyBudget(
        Region $region,
        ProfileList $profiles
    ): ProfilesDailyBudgetUpdateResponse {
        return ProfilesDailyBudgetUpdateResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        body: new ProfilesDailyBudgetUpdateRequest($profiles)
                    ),
                    __FUNCTION__
                )
            )
        );
    }
}
