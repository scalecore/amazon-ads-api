<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Models\Errors\ApiError;

test(
    'ApiError from string props is valid',
    function () {
        $strProps = <<<HERE
{
    "code": 404,
    "details": "Object or resource not found."
}
HERE;

        $error = new ApiError($strProps);
        expect($error->getCode())->toEqual('404');
        expect($error->getMessage())->toEqual('Object or resource not found.');
    }
);

test(
    'ApiError from array props is valid',
    function () {
        $arrProps = [
            'code'    => 404,
            'details' => 'Object or resource not found.',
        ];

        $error = new ApiError($arrProps);
        expect($error->getCode())->toEqual('404');
        expect($error->getMessage())->toEqual('Object or resource not found.');
    }
);

test(
    'ApiError from object props is valid',
    function () {
        $objProps = (object) [
            'code'    => 404,
            'details' => 'Object or resource not found.',
        ];

        $error = new ApiError($objProps);
        expect($error->getCode())->toEqual('404');
        expect($error->getMessage())->toEqual('Object or resource not found.');
    }
);
