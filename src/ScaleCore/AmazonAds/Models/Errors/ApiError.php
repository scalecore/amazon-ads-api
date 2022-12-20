<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Errors;

use ScaleCore\AmazonAds\Contracts\ApiErrorInterface;
use ScaleCore\AmazonAds\Models\BaseModel;
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
    public ?string $message;

    /**
     * A human-readable description of the error.
     */
    #[Json]
    public ?string $details;

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getMessage(): ?string
    {
        return $this->message ?? $this->details;
    }

    public function getDetails(): ?string
    {
        return $this->details ?? $this->message;
    }
}
