<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Enums\AuthorizationGrantType;

test(
    'AuthorizationGrantType description method',
    function () {
        expect(AuthorizationGrantType::AUTHORIZATION_CODE->description())->toEqual('Used to exchange an LWA authorization code for a refresh token.');
        expect(AuthorizationGrantType::REFRESH_TOKEN->description())->toEqual('Used to exchange a refresh token for an access token.');
        expect(AuthorizationGrantType::CLIENT_CREDENTIALS->description())->toEqual('Used to get temporary client credentials when assuming a role.');
    }
);
