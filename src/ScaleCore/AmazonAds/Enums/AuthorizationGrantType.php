<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums;

enum AuthorizationGrantType: string
{
    case AUTHORIZATION_CODE = 'authorization_code';
    case REFRESH_TOKEN      = 'refresh_token';
    case CLIENT_CREDENTIALS = 'client_credentials';

    public function description(): string
    {
        return match ($this) {
            self::AUTHORIZATION_CODE => 'Used to exchange an LWA authorization code for a refresh token.',
            self::REFRESH_TOKEN      => 'Used to exchange a refresh token for an access token.',
            self::CLIENT_CREDENTIALS => 'Used to get temporary client credentials when assuming a role.',
        };
    }
}
