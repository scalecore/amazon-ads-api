<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Errors;

final class ApiThrottlingError extends ApiError
{
    /**
     * Delay in seconds, before the next re-try attempt to the operation is recommended.
     */
    private int $retryAfter = 0;

    /**
     * Set the delay in seconds before the next re-try attempt to the operation is recommended.
     */
    public function setRetryAfter(int $retryAfter): self
    {
        $this->retryAfter = $retryAfter;

        return $this;
    }

    /**
     * Returns the delay in seconds, before the next re-try attempt to the operation is recommended.
     */
    public function getRetryAfter(): int
    {
        return $this->retryAfter;
    }
}
