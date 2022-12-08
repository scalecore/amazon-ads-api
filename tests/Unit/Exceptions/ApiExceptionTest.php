<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Exceptions\ApiException;

test(
    'ApiException properly instantiates',
    function () {
        expect(new ApiException('Test'))->toBeInstanceOf(ApiException::class);
    }
);
