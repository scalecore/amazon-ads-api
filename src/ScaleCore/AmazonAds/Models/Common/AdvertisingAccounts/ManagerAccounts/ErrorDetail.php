<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts;

use ScaleCore\AmazonAds\Models\ApiError;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class ErrorDetail extends ApiError
{
    use JsonSerialize;

    /**
     * A human-readable description of the error.
     */
    #[Json('message')]
    public ?string $details;
}
