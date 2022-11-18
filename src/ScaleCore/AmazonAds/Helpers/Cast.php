<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Helpers;

use ScaleCore\AmazonAds\Exceptions\ClassNotFoundException;

final class Cast
{
    /** Allowed values that are treated as `true`. */
    private const TRUE_VALUES = ['1', 'true', 'True', 'TRUE', 1, true];

    /** Allowed values that are treated as `false`. */
    private const FALSE_VALUES = ['0', 'false', 'False', 'FALSE', 0, false];

    private function __construct()
    {
        /* Not instantiable, static class only. */
    }

    public static function toInt(mixed $value): int
    {
        return (int) $value;
    }

    public static function toFloat(mixed $value): float
    {
        return (float) $value;
    }

    public static function toString(mixed $value): string
    {
        return (string) $value;
    }

    public static function toBool(mixed $value): bool
    {
        return match (true) {
            \in_array($value, self::TRUE_VALUES, strict: true)  => true,
            \in_array($value, self::FALSE_VALUES, strict: true) => false,
            default                                             => (bool) $value,
        };
    }

    /**
     * @return array<array-key, mixed>
     */
    public static function toArray(mixed $value): array
    {
        return (array) $value;
    }

    public static function toObject(mixed $value): object
    {
        return (object) $value;
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $className
     *
     * @return T
     *
     * @throws ClassNotFoundException
     * @throws \UnexpectedValueException
     */
    public static function toClassInstance(string $className, mixed $value): object
    {
        if ( ! \class_exists($className)) {
            throw new ClassNotFoundException(\sprintf('Failed to cast property to type `%s`.', $className), $className);
        }

        if ($value instanceof $className) {
            return $value;
        }

        if (\enum_exists($className)) {
            if (\is_int($value) || \is_string($value)) {
                /** @var class-string<T> $className */
                return self::toEnumInstance($className, $value);
            }

            throw new \UnexpectedValueException(
                sprintf(
                    'Invalid value type `%s` provided for enum `%s`, expecting `string` or `int`.',
                    gettype($value),
                    $className
                )
            );
        }

        return new $className($value);
    }

    /**
     * Wrapper for json_decode.
     *
     * @see http://www.php.net/manual/en/function.json-decode.php
     *
     * @throws \JsonException
     */
    public static function fromJson(string $json, ?bool $associative = null): mixed
    {
        return json_decode($json, associative: $associative, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * Wrapper for JSON encoding.
     *
     * @see http://www.php.net/manual/en/function.json-encode.php
     *
     * @throws \JsonException
     */
    public static function toJson(mixed $value): string
    {
        return \json_encode(value: $value, flags: JSON_THROW_ON_ERROR);
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $className
     *
     * @return T
     */
    private static function toEnumInstance(string $className, int|string $value): object
    {
        $implements = \class_implements($className);

        if ($implements !== false && Arr::has($implements, \BackedEnum::class)) {
            /** @var \BackedEnum $className */
            $enum = $className::from($value);
        } else {
            $enum = constant($className . "::$value");
        }

        /** @var T $enum */
        return $enum;
    }
}
