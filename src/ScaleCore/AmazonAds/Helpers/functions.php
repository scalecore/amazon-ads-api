<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Helpers;

/**
 * Call the given Closure with the given value then return the value.
 */
function tap(mixed $value, callable $callback): mixed
{
    $callback($value);

    return $value;
}

/**
 * Return the default value of the given value.
 */
function value(mixed $value, mixed ...$args): mixed
{
    return $value instanceof \Closure ? $value(...$args) : $value;
}

/**
 * Get the class "basename" of the given object / class.
 */
function class_basename(string|object $class): string
{
    $class = \is_object($class) ? \get_class($class) : $class;

    return \basename(\str_replace('\\', '/', $class));
}
