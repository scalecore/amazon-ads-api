<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Common\AdvertisingAccounts;

use ScaleCore\AmazonAds\API\SubLevelSDK;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;
use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\ManagerAccounts\ManagerAccountType;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\Region;
use ScaleCore\AmazonAds\Exceptions\ApiException;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\AccountToUpdateList;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\ErrorDetail;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\ManagerAccount;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\RequestBodies\CreateManagerAccountRequest;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\RequestBodies\UpdateAdvertisingAccountsInManagerAccountRequest;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\Responses\GetManagerAccountsResponse;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\Responses\UpdateAdvertisingAccountsInManagerAccountResponse;

final class ManagerAccountsSDK extends SubLevelSDK implements AdsSDKInterface
{
    /** @var array<string, array<string, mixed>> */
    protected array $resourceData = [
        'getManagerAccounts' => [
            'path'       => '/managerAccounts',
            'httpMethod' => HttpMethod::GET,
            'accept'     => 'application/vnd.getmanageraccountsresponse.v1+json',
        ],
        'createManagerAccount' => [
            'path'         => '/managerAccounts',
            'httpMethod'   => HttpMethod::POST,
            'accept'       => 'application/vnd.manageraccount.v1+json',
            'content-type' => 'application/vnd.createmanageraccountrequest.v1+json',
        ],
        'associateWithManagerAccount' => [
            'path'        => '/managerAccounts/{managerAccountId}/associate',
            'httpMethod'  => HttpMethod::POST,
            'accept'      => 'application/vnd.updateadvertisingaccountsinmanageraccountresponse.v1+json',
            'contentType' => 'application/vnd.updateadvertisingaccountsinmanageraccountrequest.v1+json',
        ],
        'disassociateWithManagerAccount' => [
            'path'        => '/managerAccounts/{managerAccountId}/disassociate',
            'httpMethod'  => HttpMethod::POST,
            'accept'      => 'application/vnd.updateadvertisingaccountsinmanageraccountresponse.v1+json',
            'contentType' => 'application/vnd.updateadvertisingaccountsinmanageraccountrequest.v1+json',
        ],
    ];

    /**
     * Returns all Manager accounts that a user has access to, along with metadata for
     * all Amazon Advertising accounts that are linked to the Manager account.
     *
     * @throws \JsonException
     * @throws ApiException
     */
    public function getManagerAccounts(Region $region): GetManagerAccountsResponse
    {
        $responseResource = $this->getResponseResource(
            region: $region,
            requestResourceData: $this->getRequestResource(__FUNCTION__)
        );

        if ($responseResource->hasSucceeded()) {
            return GetManagerAccountsResponse::fromJsonData($responseResource->decodeResponseBody());
        }

        $this->throwApiResponseException(responseResource: $responseResource);
    }

    /**
     * Creates a new Amazon Advertising Manager account.
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function createManagerAccount(
        Region $region,
        string $managerAccountName,
        ManagerAccountType $managerAccountType
    ): ManagerAccount {
        $responseResource = $this->getResponseResource(
            region: $region,
            requestResourceData: $this->getRequestResource(__FUNCTION__),
            body: new CreateManagerAccountRequest($managerAccountName, $managerAccountType)
        );

        if ($responseResource->hasSucceeded()) {
            return ManagerAccount::fromJsonData($responseResource->decodeResponseBody());
        }

        $this->throwApiResponseException(
            responseResource: $responseResource,
            apiError: ErrorDetail::fromJsonData($responseResource->decodeResponseBody())
        );
    }

    /**
     * Link Amazon Advertising accounts or advertisers with a Manager Account.
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function associateWithManagerAccount(
        Region $region,
        string $managerAccountId,
        AccountToUpdateList $accounts
    ): UpdateAdvertisingAccountsInManagerAccountResponse {
        $responseResource = $this->getResponseResource(
            region: $region,
            requestResourceData: $this->getRequestResource(
                __FUNCTION__,
                ['{managerAccountId}' => $managerAccountId]
            ),
            body: new UpdateAdvertisingAccountsInManagerAccountRequest($accounts)
        );

        if ($responseResource->hasSucceeded()) {
            return UpdateAdvertisingAccountsInManagerAccountResponse::fromJsonData($responseResource->decodeResponseBody());
        }

        $this->throwApiResponseException(
            responseResource: $responseResource,
            apiError: ErrorDetail::fromJsonData($responseResource->decodeResponseBody())
        );
    }

    /**
     * Unlink Amazon Advertising accounts or advertisers with a Manager Account.
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function disassociateWithManagerAccount(
        Region $region,
        string $managerAccountId,
        AccountToUpdateList $accounts
    ): UpdateAdvertisingAccountsInManagerAccountResponse {
        $responseResource = $this->getResponseResource(
            region: $region,
            requestResourceData: $this->getRequestResource(
                __FUNCTION__,
                ['{managerAccountId}' => $managerAccountId]
            ),
            body: new UpdateAdvertisingAccountsInManagerAccountRequest($accounts)
        );

        if ($responseResource->hasSucceeded()) {
            return UpdateAdvertisingAccountsInManagerAccountResponse::fromJsonData($responseResource->decodeResponseBody());
        }

        $this->throwApiResponseException(
            responseResource: $responseResource,
            apiError: ErrorDetail::fromJsonData($responseResource->decodeResponseBody())
        );
    }
}
