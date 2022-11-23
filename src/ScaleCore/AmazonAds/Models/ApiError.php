<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use ScaleCore\AmazonAds\Contracts\ApiErrorInterface;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

class ApiError extends BaseModel implements ApiErrorInterface
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
    public ?string $details;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }
}
