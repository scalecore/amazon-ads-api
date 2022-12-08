<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Exceptions\ClassNotFoundException;

test(
    'ClassNotFoundException properly instantiates',
    function () {
        expect(new ClassNotFoundException('Test', 'SomeClassName'))->toBeInstanceOf(ClassNotFoundException::class);
        expect((new ClassNotFoundException('Test', 'SomeClassName'))->getClassName())->toEqual('SomeClassName');
    }
);
