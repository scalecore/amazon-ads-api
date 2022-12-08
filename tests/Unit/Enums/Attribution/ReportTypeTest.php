<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Enums\Attribution\PerformanceReportMetric;
use ScaleCore\AmazonAds\Enums\Attribution\ProductReportMetric;
use ScaleCore\AmazonAds\Enums\Attribution\ReportType;

test(
    'ReportType allowedMetricType method',
    function () {
        expect(ReportType::PERFORMANCE->allowedMetricType())->toEqual(PerformanceReportMetric::class);
        expect(ReportType::PRODUCTS->allowedMetricType())->toEqual(ProductReportMetric::class);
    }
);
