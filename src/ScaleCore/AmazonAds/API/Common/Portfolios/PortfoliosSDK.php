<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Common\Portfolios;

use ScaleCore\AmazonAds\API\SubLevelSDK;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;
use ScaleCore\AmazonAds\Enums\Common\Portfolio\PortfolioState;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\Region;
use ScaleCore\AmazonAds\Exceptions\ApiException;
use ScaleCore\AmazonAds\Helpers\Cast;
use ScaleCore\AmazonAds\Models\Common\Portfolios\Portfolio;
use ScaleCore\AmazonAds\Models\Common\Portfolios\PortfolioEx;
use ScaleCore\AmazonAds\Models\Common\Portfolios\PortfolioList;
use ScaleCore\AmazonAds\Models\Common\Portfolios\RequestBodies\PortfolioBudgetUsageRequest;
use ScaleCore\AmazonAds\Models\Common\Portfolios\RequestBodies\PortfolioCreateRequest;
use ScaleCore\AmazonAds\Models\Common\Portfolios\RequestBodies\PortfolioUpdateRequest;
use ScaleCore\AmazonAds\Models\Common\Portfolios\RequestParams\GetPortfoliosParams;
use ScaleCore\AmazonAds\Models\Common\Portfolios\Responses\CreateOrUpdatePortfoliosResponse;
use ScaleCore\AmazonAds\Models\Common\Portfolios\Responses\GetPortfoliosExtendedResponse;
use ScaleCore\AmazonAds\Models\Common\Portfolios\Responses\GetPortfoliosResponse;
use ScaleCore\AmazonAds\Models\Common\Portfolios\Responses\PortfolioBudgetUsageResponse;

final class PortfoliosSDK extends SubLevelSDK implements AdsSDKInterface
{
    /** @var array<string, array<string, mixed>> */
    protected array $resourceData = [
        'getPortfolios' => [
            'path'       => '/v2/portfolios/',
            'httpMethod' => HttpMethod::GET,
        ],
        'getPortfolio' => [
            'path'       => '/v2/portfolios/{portfolioId}/',
            'httpMethod' => HttpMethod::GET,
        ],
        'createPortfolios' => [
            'path'       => '/v2/portfolios/',
            'httpMethod' => HttpMethod::POST,
        ],
        'updatePortfolios' => [
            'path'       => '/v2/portfolios/',
            'httpMethod' => HttpMethod::PUT,
        ],
        'getPortfoliosExtended' => [
            'path'       => '/v2/portfolios/extended/',
            'httpMethod' => HttpMethod::GET,
        ],
        'getPortfolioExtended' => [
            'path'       => '/v2/portfolios/extended/{portfolioId}/',
            'httpMethod' => HttpMethod::GET,
        ],
        'getPortfoliosBudgetUsage' => [
            'path'        => '/portfolios/budget/usage/',
            'httpMethod'  => HttpMethod::POST,
            'accept'      => 'application/vnd.portfoliobudgetusage.v1+json',
            'contentType' => 'application/vnd.portfoliobudgetusage.v1+json',
        ],
    ];

    /**
     * @param array<array-key, int>            $portfolioIds
     * @param array<array-key, string>         $portfolioNames
     * @param array<array-key, PortfolioState> $portfolioStates
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function getPortfolios(
        Region $region,
        int $profileId,
        array $portfolioIds = [],
        array $portfolioNames = [],
        array $portfolioStates = []
    ): GetPortfoliosResponse {
        return GetPortfoliosResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        profileId: $profileId,
                        requestParams: new GetPortfoliosParams(
                            [
                                'portfolioIdFilter'    => $portfolioIds,
                                'portfolioNameFilter'  => $portfolioNames,
                                'portfolioStateFilter' => $portfolioStates,
                            ]
                        )
                    ),
                    __FUNCTION__
                )
            )
        );
    }

    /**
     * @throws ApiException
     * @throws \JsonException
     */
    public function getPortfolio(
        Region $region,
        int $profileId,
        int $portfolioId
    ): Portfolio {
        return Portfolio::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(
                            __FUNCTION__,
                            ['{portfolioId}' => Cast::toString($portfolioId)]
                        ),
                        profileId: $profileId
                    ),
                    __FUNCTION__
                )
            )
        );
    }

    /**
     * @throws ApiException
     * @throws \JsonException
     */
    public function createPortfolios(
        Region $region,
        int $profileId,
        PortfolioList $portfolios
    ): CreateOrUpdatePortfoliosResponse {
        return CreateOrUpdatePortfoliosResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        profileId: $profileId,
                        body: new PortfolioCreateRequest($portfolios)
                    ),
                    __FUNCTION__
                )
            )
        );
    }

    /**
     * @throws ApiException
     * @throws \JsonException
     */
    public function updatePortfolios(
        Region $region,
        int $profileId,
        PortfolioList $portfolios
    ): CreateOrUpdatePortfoliosResponse {
        return CreateOrUpdatePortfoliosResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        profileId: $profileId,
                        body: new PortfolioUpdateRequest($portfolios)
                    ),
                    __FUNCTION__
                )
            )
        );
    }

    /**
     * @param array<array-key, int>            $portfolioIds
     * @param array<array-key, string>         $portfolioNames
     * @param array<array-key, PortfolioState> $portfolioStates
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function getPortfoliosExtended(
        Region $region,
        int $profileId,
        array $portfolioIds = [],
        array $portfolioNames = [],
        array $portfolioStates = []
    ): GetPortfoliosExtendedResponse {
        return GetPortfoliosExtendedResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        profileId: $profileId,
                        requestParams: new GetPortfoliosParams(
                            [
                                'portfolioIdFilter'    => $portfolioIds,
                                'portfolioNameFilter'  => $portfolioNames,
                                'portfolioStateFilter' => $portfolioStates,
                            ]
                        )
                    ),
                    __FUNCTION__
                )
            )
        );
    }

    /**
     * @throws ApiException
     * @throws \JsonException
     */
    public function getPortfolioExtended(
        Region $region,
        int $profileId,
        int $portfolioId
    ): PortfolioEx {
        return PortfolioEx::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(
                            __FUNCTION__,
                            ['{portfolioId}' => Cast::toString($portfolioId)]
                        ),
                        profileId: $profileId
                    ),
                    __FUNCTION__
                )
            )
        );
    }

    /**
     * @param array<array-key, string> $portfolioIds
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function getPortfoliosBudgetUsage(
        Region $region,
        int $profileId,
        array $portfolioIds
    ): PortfolioBudgetUsageResponse {
        return PortfolioBudgetUsageResponse::fromJsonData(
            $this->decodeResponseBody(
                $this->getResponse(
                    $this->getRequest(
                        region: $region,
                        requestResourceData: $this->getRequestResource(__FUNCTION__),
                        profileId: $profileId,
                        body: new PortfolioBudgetUsageRequest($portfolioIds)
                    ),
                    __FUNCTION__
                )
            )
        );
    }
}
