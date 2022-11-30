<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Common\Portfolio;

enum PortfolioBudgetPolicy: string
{
    case DATE_RANGE        = 'dateRange';
    case MONTHLY_RECURRING = 'monthlyRecurring';
}
