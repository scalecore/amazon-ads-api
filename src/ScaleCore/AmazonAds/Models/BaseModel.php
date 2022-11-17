<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use ScaleCore\AmazonAds\Contracts\Jsonable;
use ScaleCore\AmazonAds\Helpers\Cast;
use Square\Pjson\Internal\RClass;
use Square\Pjson\Json;

abstract class BaseModel implements Jsonable
{
    /**
     * @param object|array<array-key, mixed>|string $properties
     */
    public function __construct(object|array|string $properties)
    {
        $this->constructFromMixedData($properties);
    }

    public function __get(string $name): mixed
    {
        if ( ! \property_exists($this, $name)) {
            \trigger_error('Undefined property: ' . \get_class($this) . '::$' . $name, E_USER_ERROR);
        }

        return $this->$name;
    }

    /**
     * @param object|array<array-key, mixed>|string $properties
     */
    protected function constructFromMixedData(object|array|string $properties): void
    {
        $jd    = $this->normalizeProperties($properties);
        $r     = RClass::make(self::class);
        $props = $r->getProperties();
        foreach ($props as $prop) {
            $attrs = $prop->getAttributes(Json::class, \ReflectionAttribute::IS_INSTANCEOF);
            if ($attrs === []) {
                continue;
            }

            $type = $prop->getType();
            $v    = $attrs[0]->newInstance()->forProperty($prop)->retrieveValue($jd, $type);
            if (is_null($v) && $type && ! $type->allowsNull()) {
                continue;
            }

            $prop->setValue($this, $v);
        }
    }

    /**
     * @param object|array<array-key, mixed>|string $properties
     *
     * @return array<array-key, mixed>
     *
     * @throws \JsonException
     */
    protected function normalizeProperties(object|array|string $properties): array
    {
        $properties = \is_array($properties) && \array_is_list($properties) ? $properties[0] ?? [] : $properties;

        if (\is_object($properties)) {
            return \get_object_vars($properties);
        }

        return \is_string($properties) ? Cast::fromJson($properties, associative: true) : $properties;
    }
}
