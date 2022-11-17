<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Enums\CountryCode;
use ScaleCore\AmazonAds\Enums\PrimitiveType;
use ScaleCore\AmazonAds\Exceptions\ClassNotFoundException;
use ScaleCore\AmazonAds\Helpers\Cast;
use ScaleCore\AmazonAds\Models\Attribution\RequestParams\TagParams;

test(
    'Cast to method with PrimitiveType::BOOL',
    function () {
        foreach (['1', 'true', 'True', 'TRUE', 1, true] as $value) {
            expect(Cast::to(PrimitiveType::BOOL, $value))->toBeTrue();
        }

        foreach (['0', 'false', 'False', 'FALSE', 0, false] as $value) {
            expect(Cast::to(PrimitiveType::BOOL, $value))->toBeFalse();
        }
    }
);

test(
    'Cast to method with PrimitiveType::INT',
    function () {
        expect(Cast::to(PrimitiveType::INT, '5'))->toEqual(5);
        expect(Cast::to(PrimitiveType::INT, '5.5'))->toEqual(5);
        expect(Cast::to(PrimitiveType::INT, '5abCDh'))->toEqual(5);
        expect(Cast::to(PrimitiveType::INT, 'abcde'))->toEqual(0);
        expect(Cast::to(PrimitiveType::INT, 'abcde5'))->toEqual(0);
    }
);

test(
    'Cast to method with PrimitiveType::FLOAT',
    function () {
        expect(Cast::to(PrimitiveType::FLOAT, '5'))->toEqual(5.0);
        expect(Cast::to(PrimitiveType::FLOAT, '5.5'))->toEqual(5.5);
        expect(Cast::to(PrimitiveType::FLOAT, '5abCDh'))->toEqual(5.0);
        expect(Cast::to(PrimitiveType::FLOAT, '5.5abCDh'))->toEqual(5.5);
        expect(Cast::to(PrimitiveType::FLOAT, 'abcde'))->toEqual(0.0);
        expect(Cast::to(PrimitiveType::FLOAT, 'abcde5'))->toEqual(0.0);
    }
);

test(
    'Cast to method with PrimitiveType::STRING',
    function () {
        $class = new class() {
            public function __toString(): string
            {
                return 'foo';
            }
        };
        expect(Cast::to(PrimitiveType::STRING, 5))->toEqual('5');
        expect(Cast::to(PrimitiveType::STRING, 5.5))->toEqual('5.5');
        expect(Cast::to(PrimitiveType::STRING, $class))->toEqual('foo');
    }
);

test(
    'Cast to method with PrimitiveType::ARRAY',
    function () {
        $arr = ['foo', 'bar'];
        expect(Cast::to(PrimitiveType::ARRAY, (object) $arr))->toEqual($arr);
        expect(Cast::to(PrimitiveType::ARRAY, 5))->toEqual([5]);
        expect(Cast::to(PrimitiveType::ARRAY, 'HELLO'))->toEqual(['HELLO']);
    }
);

test(
    'Cast to method with PrimitiveType::OBJECT',
    function () {
        $arr        = ['foo', 'bar'];
        $obj        = new \stdClass();
        $obj->{'0'} = 'foo';
        $obj->{'1'} = 'bar';
        expect(Cast::to(PrimitiveType::OBJECT, $arr))->toEqual($obj);

        $obj         = new \stdClass();
        $obj->scalar = 5;
        expect(Cast::to(PrimitiveType::OBJECT, 5))->toEqual($obj);
    }
);

test(
    'Cast to method with enum object type',
    function () {
        expect(Cast::to(CountryCode::class, 'US'))->toEqual(CountryCode::US);
        expect(Cast::to(PrimitiveType::class, 'BOOL'))->toEqual(PrimitiveType::BOOL);
    }
);

test(
    'Cast to method with enum object type and invalid value',
    function () {
        Cast::to(CountryCode::class, ['foo']);
    }
)->throws(UnexpectedValueException::class);

test(
    'Cast to method with class instance type',
    function () {
        expect(Cast::to(TagParams::class, ['publisherIds' => ['1234', '5678']]))->toBeInstanceOf(TagParams::class);

        expect(Cast::to(TagParams::class, new TagParams(['publisherIds' => ['1234', '5678']])))
            ->toBeInstanceOf(TagParams::class);
    }
);

test(
    'Cast to method with invalid class instance type',
    function () {
        Cast::to('SomeBsClass', ['publisherIds' => ['1234', '5678']]);
    }
)->throws(ClassNotFoundException::class);

test(
    'Cast toJson method',
    function () {
        $val = Cast::toJson((object) ['foo' => 'bar']);
        expect($val)->toBeJson();
        expect($val)->json()->toHaveCount(1)->foo->toBe('bar');
    }
);

test(
    'Cast fromJson method',
    function () {
        $val = Cast::fromJson('{"foo":"bar"}');
        expect($val)->toBeObject();
        expect($val)->toMatchObject(['foo' => 'bar']);

        $val = Cast::fromJson('{"foo":"bar"}', true);
        expect($val)->toBeArray();
        expect($val)->toMatchArray(['foo' => 'bar']);
    }
);
