<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts;

interface ApiErrorInterface
{
    /**
     * Get the string code of the error.
     */
    public function getCode(): ?string;

    /**
     * Get the human-readable message/details of the error.
     */
    public function getMessage(): ?string;

    /**
     * Get the human-readable details/message of the error.
     */
    public function getDetails(): ?string;
}
