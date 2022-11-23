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
     * Get the details of the error.
     */
    public function getDetails(): ?string;
}
