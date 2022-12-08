<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class ErrorDetail extends BaseModel
{
    use JsonSerialize;

    /**
     * The error code.
     */
    #[Json]
    public ?string $code;

    /**
     * A human-readable description of the error.
     */
    #[Json]
    public ?string $message;
}
