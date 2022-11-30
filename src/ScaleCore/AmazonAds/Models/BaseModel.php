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
     * @param object|array<array-key, mixed>|string $properties = null
     *
     * @throws \JsonException
     */
    public function __construct(object|array|string $properties = [])
    {
        $this->constructFromMixedData($properties);
    }

    /**
     * @param object|array<array-key, mixed>|string $properties
     *
     * @throws \JsonException
     */
    protected function constructFromMixedData(object|array|string $properties): void
    {
        $jd    = $this->normalizeProperties($properties);
        $props = RClass::make(self::class)->getProperties();
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
