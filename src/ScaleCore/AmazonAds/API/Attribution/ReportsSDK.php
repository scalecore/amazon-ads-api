<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\API\Attribution;

use ScaleCore\AmazonAds\API\SubLevelSDK;
use ScaleCore\AmazonAds\Contracts\AdsSDKInterface;
use ScaleCore\AmazonAds\Enums\Attribution\PerformanceReportGroupBy;
use ScaleCore\AmazonAds\Enums\Attribution\PerformanceReportMetric;
use ScaleCore\AmazonAds\Enums\Attribution\ProductReportMetric;
use ScaleCore\AmazonAds\Enums\HttpMethod;
use ScaleCore\AmazonAds\Enums\Region;
use ScaleCore\AmazonAds\Exceptions\ApiException;
use ScaleCore\AmazonAds\Models\Attribution\PerformanceReportEntry;
use ScaleCore\AmazonAds\Models\Attribution\RequestBodies\PerformanceReportRequest;
use ScaleCore\AmazonAds\Models\Attribution\RequestBodies\ProductReportRequest;
use ScaleCore\AmazonAds\Models\Attribution\Responses\PerformanceReportResponse;
use ScaleCore\AmazonAds\Models\Attribution\Responses\ProductReportResponse;
use function ScaleCore\AmazonAds\Helpers\tap;

final class ReportsSDK extends SubLevelSDK implements AdsSDKInterface
{
    /** @var array<string, array<string, mixed>> */
    protected array $resourceData = [
        'getProductReports' => [
            'path'       => '/attribution/report',
            'httpMethod' => HttpMethod::POST,
        ],
        'getPerformanceReports' => [
            'path'       => '/attribution/report',
            'httpMethod' => HttpMethod::POST,
        ],
    ];

    /**
     * @param array<array-key, int>                 $advertiserIds
     * @param array<array-key, ProductReportMetric> $metrics
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function getProductReports(
        Region $region,
        int $profileId,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        array $advertiserIds,
        array $metrics = [],
        int $count = 5000,
        ?string $cursorId = null
    ): ProductReportResponse {
        $responseResource = $this->getResponseResource(
            region: $region,
            requestResourceData: $this->getRequestResource(__FUNCTION__),
            profileId: $profileId,
            body: new ProductReportRequest(
                startDate: $startDate,
                endDate: $endDate,
                advertiserIds: $advertiserIds,
                metrics: $metrics,
                count: $count,
                cursorId: $cursorId
            )
        );

        if ($responseResource->hasSucceeded()) {
            return ProductReportResponse::fromJsonData($responseResource->decodeResponseBody())
                ->setCorrelationId($responseResource->getCorrelationId());
        }

        $this->throwApiResponseException(responseResource: $responseResource);
    }

    /**
     * @param array<array-key, int>                     $advertiserIds
     * @param array<array-key, PerformanceReportMetric> $metrics
     *
     * @throws ApiException
     * @throws \JsonException
     */
    public function getPerformanceReports(
        Region $region,
        int $profileId,
        \DateTimeInterface $startDate,
        \DateTimeInterface $endDate,
        array $advertiserIds,
        array $metrics = [],
        int $count = 5000,
        ?string $cursorId = null,
        PerformanceReportGroupBy $groupBy = PerformanceReportGroupBy::CREATIVE
    ): PerformanceReportResponse {
        $responseResource = $this->getResponseResource(
            region: $region,
            requestResourceData: $this->getRequestResource(__FUNCTION__),
            profileId: $profileId,
            body: new PerformanceReportRequest(
                startDate: $startDate,
                endDate: $endDate,
                advertiserIds: $advertiserIds,
                metrics: $metrics,
                count: $count,
                cursorId: $cursorId,
                groupBy: $groupBy
            )
        );

        if ($responseResource->hasSucceeded()) {
            return $this->addGroupByToResponse(
                $groupBy,
                PerformanceReportResponse::fromJsonData($responseResource->decodeResponseBody())
                    ->setCorrelationId($responseResource->getCorrelationId())
            );
        }

        $this->throwApiResponseException(responseResource: $responseResource);
    }

    private function addGroupByToResponse(
        PerformanceReportGroupBy $groupBy,
        PerformanceReportResponse $response
    ): PerformanceReportResponse {
        return tap(
            $response,
            function (PerformanceReportResponse $response) use ($groupBy) {
                /** @var PerformanceReportEntry $report */
                foreach ($response->reports ?? [] as $report) {
                    $report->groupBy = $groupBy;
                }
            }
        );
    }
}
