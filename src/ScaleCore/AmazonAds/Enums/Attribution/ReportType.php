<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Attribution;

enum ReportType: string
{
    case PERFORMANCE = 'PERFORMANCE';
    case PRODUCTS    = 'PRODUCTS';

    public function allowedMetricType(): string
    {
        return match ($this) {
            self::PERFORMANCE => PerformanceReportMetric::class,
            self::PRODUCTS    => ProductReportMetric::class,
        };
    }
}
