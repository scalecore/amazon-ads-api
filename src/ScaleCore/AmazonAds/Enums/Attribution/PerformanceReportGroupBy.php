<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Attribution;

enum PerformanceReportGroupBy: string
{
    case CAMPAIGN = 'CAMPAIGN';
    case ADGROUP  = 'ADGROUP';
    case CREATIVE = 'CREATIVE';
}
