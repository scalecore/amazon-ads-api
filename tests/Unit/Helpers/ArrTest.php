<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Helpers\Arr;

test(
    'Arr::accessible helper function',
    function () {
        expect(Arr::accessible([]))->toBeTrue();
        expect(Arr::accessible([1, 2]))->toBeTrue();
        expect(Arr::accessible(['a' => 1, 'b' => 2]))->toBeTrue();
        expect(Arr::accessible(getArrTestArrayAccessObject([])))->toBeTrue();

        expect(Arr::accessible(null))->toBeFalse();
        expect(Arr::accessible('abc'))->toBeFalse();
        expect(Arr::accessible(new stdClass()))->toBeFalse();
        expect(Arr::accessible((object) ['a' => 1, 'b' => 2]))->toBeFalse();
    }
);

test(
    'Arr::exists helper function',
    function () {
        expect(Arr::exists([1], 0))->toBeTrue();
        expect(Arr::exists([null], 0))->toBeTrue();
        expect(Arr::exists(['a' => 1], 'a'))->toBeTrue();
        expect(Arr::exists(['a' => null], 'a'))->toBeTrue();
        expect(Arr::exists(getArrTestArrayAccessObject(['a' => null]), 'a'))->toBeTrue();

        expect(Arr::exists([1], 1))->toBeFalse();
        expect(Arr::exists([null], 1))->toBeFalse();
        expect(Arr::exists(['a' => 1], 0))->toBeFalse();
        expect(Arr::exists(getArrTestArrayAccessObject(['a' => null]), 'b'))->toBeFalse();
    }
);

test(
    'Arr::has helper function',
    function () {
        $array = ['products.desk' => ['price' => 100]];
        expect(Arr::has($array, 'products.desk'))->toBeTrue();

        $array = ['products' => ['desk' => ['price' => 100]]];
        expect(Arr::has($array, 'products.desk'))->toBeTrue();
        expect(Arr::has($array, 'products.desk.price'))->toBeTrue();
        expect(Arr::has($array, 'products.foo'))->toBeFalse();
        expect(Arr::has($array, 'products.desk.foo'))->toBeFalse();

        $array = ['foo' => null, 'bar' => ['baz' => null]];
        expect(Arr::has($array, 'foo'))->toBeTrue();
        expect(Arr::has($array, 'bar.baz'))->toBeTrue();

        $array = new ArrayObject(['foo' => 10, 'bar' => new ArrayObject(['baz' => 10])]);
        expect(Arr::has($array, 'foo'))->toBeTrue();
        expect(Arr::has($array, 'bar'))->toBeTrue();
        expect(Arr::has($array, 'bar.baz'))->toBeTrue();
        expect(Arr::has($array, 'xxx'))->toBeFalse();
        expect(Arr::has($array, 'xxx.yyy'))->toBeFalse();
        expect(Arr::has($array, 'foo.xxx'))->toBeFalse();
        expect(Arr::has($array, 'bar.xxx'))->toBeFalse();

        $array = new ArrayObject(['foo' => null, 'bar' => new ArrayObject(['baz' => null])]);
        expect(Arr::has($array, 'foo'))->toBeTrue();
        expect(Arr::has($array, 'bar.baz'))->toBeTrue();

        $array = ['foo', 'bar'];
        expect(Arr::has($array, ''))->toBeFalse();

        expect(Arr::has([], ''))->toBeFalse();

        $array = ['products' => ['desk' => ['price' => 100]]];
        expect(Arr::has($array, ['products.desk']))->toBeTrue();
        expect(Arr::has($array, ['products.desk', 'products.desk.price']))->toBeTrue();
        expect(Arr::has($array, ['products', 'products']))->toBeTrue();
        expect(Arr::has($array, ['foo']))->toBeFalse();
        expect(Arr::has($array, []))->toBeFalse();
        expect(Arr::has($array, ['products.desk', 'products.price']))->toBeFalse();

        $array = [
            'products' => [
                ['name' => 'desk'],
            ],
        ];
        expect(Arr::has($array, 'products.0.name'))->toBeTrue();
        expect(Arr::has($array, 'products.0.price'))->toBeFalse();

        expect(Arr::has([], [null]))->toBeFalse();

        expect(Arr::has(['' => 'some'], ''))->toBeTrue();
        expect(Arr::has(['' => 'some'], ['']))->toBeTrue();
        expect(Arr::has([''], ''))->toBeFalse();
        expect(Arr::has([], ''))->toBeFalse();
        expect(Arr::has([], ['']))->toBeFalse();
    }
);

test(
    'Arr::get helper function',
    function () {
        // Test invalid int key
        expect(Arr::get(['foo', 'bar'], 2))->toBeNull();
        expect(Arr::get(['foo', 'bar'], 2, 'baz'))->toEqual('baz');

        expect(Arr::get(['products.desk' => ['price' => 100]], 'products.desk'))->toEqual(['price' => 100]);

        // Test invalid string key with dot
        expect(Arr::get(['products' => ['desk' => ['price' => 100]]], 'products.price'))->toBeNull();

        expect(Arr::get(['products' => ['desk' => ['price' => 100]]], 'products.desk'))->toEqual(['price' => 100]);

        // Test string key with no dot
        expect(Arr::get(['products' => ['desk' => ['price' => 100]]], 'products'))
            ->toEqual(['desk' => ['price' => 100]]);

        // Test invalid string key with no dot
        expect(Arr::get(['products' => ['desk' => ['price' => 100]]], 'product'))
            ->toBeNull();

        // Test null array values
        $array = ['foo' => null, 'bar' => ['baz' => null]];
        expect(Arr::get($array, 'foo', 'default'))->toBeNull();
        expect(Arr::get($array, 'bar.baz', 'default'))->toBeNull();

        // Test direct ArrayAccess object
        expect(Arr::get(new ArrayObject(['products' => ['desk' => ['price' => 100]]]), 'products.desk'))
            ->toEqual(['price' => 100]);

        // Test array containing ArrayAccess object
        expect(
            Arr::get(
                ['child' => new ArrayObject(['products' => ['desk' => ['price' => 100]]])],
                'child.products.desk'
            )
        )->toEqual(['price' => 100]);

        // Test null key returns the whole array
        $array = ['foo', 'bar'];
        expect(Arr::get($array, null))->toEqual($array);

        // Test numeric keys
        $array = [
            'products' => [
                ['name' => 'desk'],
                ['name' => 'chair'],
            ],
        ];
        expect(Arr::get($array, 'products.0.name'))->toEqual('desk');
        expect(Arr::get($array, 'products.1.name'))->toEqual('chair');

        /*// Test array containing multiple nested ArrayAccess objects
        $arrayAccessChild = new ArrayObject(['products' => ['desk' => ['price' => 100]]]);
        $arrayAccessParent = new ArrayObject(['child' => $arrayAccessChild]);
        $array = ['parent' => $arrayAccessParent];
        $value = Arr::get($array, 'parent.child.products.desk');
        $this->assertEquals(['price' => 100], $value);

        // Test missing ArrayAccess object field
        $arrayAccessChild = new ArrayObject(['products' => ['desk' => ['price' => 100]]]);
        $arrayAccessParent = new ArrayObject(['child' => $arrayAccessChild]);
        $array = ['parent' => $arrayAccessParent];
        $value = Arr::get($array, 'parent.child.desk');
        $this->assertNull($value);

        // Test missing ArrayAccess object field
        $arrayAccessObject = new ArrayObject(['products' => ['desk' => null]]);
        $array = ['parent' => $arrayAccessObject];
        $value = Arr::get($array, 'parent.products.desk.price');
        $this->assertNull($value);

        // Test null ArrayAccess object fields
        $array = new ArrayObject(['foo' => null, 'bar' => new ArrayObject(['baz' => null])]);
        $this->assertNull(Arr::get($array, 'foo', 'default'));
        $this->assertNull(Arr::get($array, 'bar.baz', 'default'));

        // Test $array not an array
        $this->assertSame('default', Arr::get(null, 'foo', 'default'));
        $this->assertSame('default', Arr::get(false, 'foo', 'default'));

        // Test $array not an array and key is null
        $this->assertSame('default', Arr::get(null, null, 'default'));

        // Test $array is empty and key is null
        $this->assertEmpty(Arr::get([], null));
        $this->assertEmpty(Arr::get([], null, 'default'));

        // Test return default value for non-existing key.
        $array = ['names' => ['developer' => 'taylor']];
        $this->assertSame('dayle', Arr::get($array, 'names.otherDeveloper', 'dayle'));
        $this->assertSame('dayle', Arr::get($array, 'names.otherDeveloper', function () {
            return 'dayle';
        }));*/
    }
);
