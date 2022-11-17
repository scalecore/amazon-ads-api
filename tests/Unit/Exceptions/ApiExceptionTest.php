<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Exceptions\ApiException;

test(
    'ClassNotFoundException properly instantiates',
    function () {
        expect(new ApiException('Test'))->toBeInstanceOf(ApiException::class);
        expect((new ApiException('Test', responseHeaders: ['foo' => 'bar']))->getResponseHeaders())
            ->toEqual(['foo' => 'bar']);
        expect((new ApiException('Test', responseBody: 'HELLO'))->getResponseBody())->toEqual('HELLO');
    }
);
