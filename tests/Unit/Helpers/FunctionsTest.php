<?php

declare(strict_types=1);

use function ScaleCore\AmazonAds\Helpers\tap;
use function ScaleCore\AmazonAds\Helpers\value;

test(
    'tap helper function',
    function () {
        $object = tap((object) ['id' => 1], fn (object $obj) => $obj->id = 2);

        expect($object->id)->toEqual(2);
    }
);

test(
    'value helper function',
    function () {
        $val = 'HELLO';

        expect(value($val))->toEqual($val);
        expect(value(fn ($tmp) => $tmp, $val))->toEqual($val);
    }
);
