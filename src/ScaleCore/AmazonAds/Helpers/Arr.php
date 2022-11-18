<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Helpers;

use ScaleCore\AmazonAds\Exceptions\ClassNotFoundException;

final class Arr
{
    private function __construct()
    {
        /* Not instantiable, static class only. */
    }

    /**
     * Determine whether the given value is array accessible.
     */
    public static function accessible(mixed $value): bool
    {
        return \is_array($value) || $value instanceof \ArrayAccess;
    }

    /**
     * Determine if the given key exists in the provided array.
     *
     * @template TKey of array-key
     * @template TValue of mixed
     *
     * @param \ArrayAccess<TKey, TValue>|array<TKey, TValue> $array
     * @param array-key                                      $key
     */
    public static function exists(\ArrayAccess|array $array, int|string $key): bool
    {
        return $array instanceof \ArrayAccess ? $array->offsetExists($key) : \array_key_exists($key, $array);
    }

    /**
     * Check if an item or items exist in an array using "dot" notation.
     *
     * @template TKey of array-key
     * @template TValue of mixed
     *
     * @param \ArrayAccess<TKey, TValue>|array<TKey, TValue> $array
     * @param string|array<array-key, string>                $keys
     *
     * @throws ClassNotFoundException
     */
    public static function has(\ArrayAccess|array $array, array|string $keys): bool
    {
        $keys = Cast::toArray($keys);

        if ( ! $array || $keys === []) {
            return false;
        }

        foreach ($keys as $key) {
            $subKeyArray = $array;

            if (self::exists($array, $key)) {
                continue;
            }

            foreach (\explode('.', $key) as $segment) {
                if (self::accessible($subKeyArray) && self::exists($subKeyArray, $segment)) {
                    $subKeyArray = $subKeyArray[$segment];
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @template TKey of array-key
     * @template TValue of mixed
     *
     * @param \ArrayAccess<TKey, TValue>|array<TKey, TValue> $array
     */
    public static function get(\ArrayAccess|array $array, string|int|null $key, mixed $default = null): mixed
    {
        if (\is_null($key)) {
            return $array;
        }

        if (self::exists($array, $key)) {
            return $array[$key];
        }

        if (\is_int($key)) {
            return value($default);
        }

        if ( ! \str_contains($key, '.')) {
            return $array[$key] ?? value($default);
        }

        foreach (\explode('.', $key) as $segment) {
            if (self::accessible($array) && self::exists($array, $segment)) {
                $array = $array[$segment];

                continue;
            }

            return value($default);
        }

        return $array;
    }
}
