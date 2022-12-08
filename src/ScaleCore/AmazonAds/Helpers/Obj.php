<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Helpers;

final class Obj
{
    private function __construct()
    {
        /* Not instantiable, static class only. */
    }

    /**
     * Transposes properties from one object (source) to another (destination).
     *
     * Destination callable should take 2 parameters.
     * First is a string property name.
     * Second is the source value.
     * It should return the value to be set for the property on the returned object.
     */
    public static function transpose(object|callable $destination, object $source, string ...$properties): object
    {
        $sourceReflectionObject = new \ReflectionObject($source);

        if (\is_callable($destination)) {
            $object      = new \stdClass();
            $destination = $destination(...);
            foreach ($properties as $property) {
                if (
                    $sourceReflectionObject->hasProperty($property)
                    && $sourceReflectionObject->getProperty($property)->isPublic()
                ) {
                    $object->{$property} = $destination($property, $source->{$property});
                }
            }

            return $object;
        }

        $destinationReflectionObject = new \ReflectionObject($destination);

        foreach ($properties as $property) {
            if (
                (
                    $sourceReflectionObject->hasProperty($property)
                    && $sourceReflectionObject->getProperty($property)->isPublic()
                )
                && (
                    $destinationReflectionObject->hasProperty($property)
                    && $destinationReflectionObject->getProperty($property)->isPublic()
                )
            ) {
                $destination->{$property} = $source->{$property};
            }
        }

        return $destination;
    }
}
