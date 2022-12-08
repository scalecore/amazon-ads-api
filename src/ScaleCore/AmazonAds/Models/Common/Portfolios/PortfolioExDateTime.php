<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios;

use ScaleCore\AmazonAds\Models\BaseDateTime;

final class PortfolioExDateTime extends BaseDateTime
{
    /**
     * The format the DateTime instance is converted to when serializing to JSON.
     *
     * Return any combination of the allowed formatting characters or \DateTimeInterface constants
     * defined at https://www.php.net/manual/en/datetime.format.php.
     *
     * To convert to an integer timestamp return a value of `U`.
     * All other formatting returns string values.
     */
    protected function getFormattingString(): string
    {
        return 'U';
    }
}
