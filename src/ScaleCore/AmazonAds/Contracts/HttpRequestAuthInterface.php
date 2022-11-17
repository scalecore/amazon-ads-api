<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Contracts;

/**
 * Provides a means to authorize an HTTP request.
 */
interface HttpRequestAuthInterface
{
    /**
     * Determines whether authentication information is present.
     */
    public function canAuthorize(): bool;

    /**
     * Gets the authentication type for API requests.
     */
    public function getAuthType(): string;

    /**
     * Gets the authentication data (access token) for API requests.
     */
    public function getAuthData(): ?string;

    /**
     * Gets the LWA client identifier for API requests.
     */
    public function getClientId(): string;
}
