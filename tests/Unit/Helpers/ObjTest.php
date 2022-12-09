<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Helpers\Obj;

test(
    'Obj transpose method works properly with object',
    function () {
        $final = (object) [
            'foo' => 'buz',
            'baz' => 'biz',
            'bar' => 'foo',
            'buz' => 'baz',
        ];

        $destination = (object) [
            'foo' => 'bar',
            'baz' => 'buz',
            'bar' => 'foo',
            'buz' => 'baz',
        ];

        $source = (object) [
            'foo' => 'buz',
            'baz' => 'biz',
        ];

        $props = ['foo', 'baz'];

        expect(Obj::transpose($destination, $source, ...$props))->toEqual($final);
    }
);

test(
    'Obj transpose method works properly with callable',
    function () {
        $final = (object) [
            'foo' => 'foo:buz',
            'baz' => 'baz:biz',
        ];

        $destination = fn (string $property, string $value) => $property . ':' . $value;

        $source = (object) [
            'foo' => 'buz',
            'baz' => 'biz',
        ];

        $props = ['foo', 'baz'];

        expect(Obj::transpose($destination, $source, ...$props))->toEqual($final);
    }
);
