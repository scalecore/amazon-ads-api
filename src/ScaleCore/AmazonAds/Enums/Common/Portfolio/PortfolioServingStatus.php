<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Common\Portfolio;

enum PortfolioServingStatus: string
{
    case PORTFOLIO_STATUS_ENABLED = 'PORTFOLIO_STATUS_ENABLED';
    case PORTFOLIO_STATUS_PAUSED  = 'PORTFOLIO_STATUS_PAUSED';
    case PORTFOLIO_ARCHIVED       = 'PORTFOLIO_ARCHIVED';
    case PORTFOLIO_OUT_OF_BUDGET  = 'PORTFOLIO_OUT_OF_BUDGET';
    case PENDING_START_DATE       = 'PENDING_START_DATE';
    case ENDED                    = 'ENDED';

    public function description(): string
    {
        return match ($this) {
            self::PORTFOLIO_STATUS_ENABLED => 'The portfolio\'s status is ENABLED.',
            self::PORTFOLIO_STATUS_PAUSED  => 'The portfolio\'s status is PAUSED.',
            self::PORTFOLIO_ARCHIVED       => 'The portfolio is archived.',
            self::PORTFOLIO_OUT_OF_BUDGET  => 'The maximum budget cap at the portfolio level has been reached.',
            self::PENDING_START_DATE       => 'The portfolio\'s start date is in the future.',
            self::ENDED                    => 'The portfolio\'s end date is in the past.',
        };
    }
}
