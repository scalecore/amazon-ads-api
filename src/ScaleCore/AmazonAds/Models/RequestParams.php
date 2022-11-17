<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use ScaleCore\AmazonAds\Contracts\Arrayable;
use ScaleCore\AmazonAds\Helpers\Arr;

/**
 * @implements Arrayable<string, mixed>
 */
abstract class RequestParams implements Arrayable, \JsonSerializable
{
    /**
     * The list of parameter names and default values.
     *
     * @var array<string, mixed>
     */
    protected array $params = [];

    /**
     * A list of parameter names and the name of their associated setter method.
     *
     * @var array<string, string>
     */
    protected array $map = [];

    /**
     * A list of array parameters that should be imploded to a single string value.
     *
     * @var array<int, string>
     */
    protected array $filters = [];

    /**
     * @param array<string, mixed> $params
     */
    public function __construct(array $params = [])
    {
        \array_walk(
            $params,
            function (mixed $value, string $key) {
                if ( ! Arr::exists($this->map, $key)) {
                    return;
                }

                $method = $this->map[$key];

                $this->{$method}($value);
            }
        );
    }

    /**
     * Get the instance as an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        $filteredParams = \array_filter($this->params, fn (mixed $val) => $val !== null && $val !== []);
        $keys           = \array_keys($filteredParams);
        $filteredParams = \array_map(
            function (mixed $value, string $key): mixed {
                if (\in_array($key, $this->filters) && Arr::accessible($value)) {
                    $value = \is_array($value) ? $value : $value->toArray();

                    return \implode(',', \array_unique($value));
                }

                return $value;
            },
            $filteredParams,
            $keys
        );

        return \array_combine($keys, $filteredParams);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
