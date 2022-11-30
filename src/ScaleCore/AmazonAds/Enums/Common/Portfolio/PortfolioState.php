<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Common\Portfolio;

enum PortfolioState: string
{
    case ENABLED  = 'enabled';
    case PAUSED   = 'paused';
    case ARCHIVED = 'archived';
}
