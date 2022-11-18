<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\Responses;

use ScaleCore\AmazonAds\Exceptions\ClassNotFoundException;
use ScaleCore\AmazonAds\Helpers\Cast;
use function ScaleCore\AmazonAds\Helpers\tap;
use ScaleCore\AmazonAds\Models\Attribution\AttributionTagMap;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property array<array-key, AttributionTagMap>|null $attributionTagMaps
 */
final class AttributionTagResponse extends BaseModel
{
    use JsonSerialize {
        fromJsonString as traitFromJsonString;
        fromJsonData as traitFromJsonData;
    }

    /** @var array<array-key, AttributionTagMap>|null */
    #[Json(type: AttributionTagMap::class)]
    protected ?array $attributionTagMaps;

    /**
     * @param object|array<array-key, mixed>|string $properties
     *
     * @throws \JsonException
     * @throws ClassNotFoundException
     */
    public function __construct(object|array|string $properties, bool $supportsMacros = true)
    {
        parent::__construct(
            tap(
                [
                    'attributionTagMaps' => [],
                ],
                function (array &$data) use ($properties, $supportsMacros): void {
                    foreach ($this->normalizeProperties($properties) as $advertiserId => $tagData) {
                        $data['attributionTagMaps'] = self::getTagMapData(
                            $advertiserId,
                            $supportsMacros,
                            Cast::toObject($tagData)
                        );
                    }
                }
            )
        );
    }

    /**
     * @param array<array-key, string>|string $path
     * @param int<1, max>                     $depth
     */
    public static function fromJsonString(
        string $json,
        array|string $path = [],
        int $depth = 512,
        int $flags = 0,
        bool $supportsMacros = true
    ): self {
        $flags |= JSON_THROW_ON_ERROR;

        return self::fromJsonData(
            json_decode($json, associative: true, depth: $depth, flags: $flags),
            $path,
            $supportsMacros
        );
    }

    /**
     * @param array<array-key, mixed>         $jd
     * @param array<array-key, string>|string $path
     *
     * @throws ClassNotFoundException
     */
    public static function fromJsonData($jd, array|string $path = [], bool $supportsMacros = true): self
    {
        return self::traitFromJsonData(
            tap(
                [
                    'attributionTagMaps' => [],
                ],
                function (array &$data) use ($jd, $supportsMacros): void {
                    foreach ($jd as $advertiserId => $tagData) {
                        $data['attributionTagMaps'] = self::getTagMapData(
                            $advertiserId,
                            $supportsMacros,
                            Cast::toObject($tagData)
                        );
                    }
                }
            ),
            $path
        );
    }

    /**
     * @return array<array-key, array<string, mixed>>
     */
    private static function getTagMapData(int $advertiserId, bool $supportsMacros, object $tagData): array
    {
        return tap(
            [],
            function (array &$data) use ($advertiserId, $supportsMacros, $tagData): void {
                foreach (\get_object_vars($tagData) as $publisherId => $tagText) {
                    $data[] = [
                        'advertiserId'   => $advertiserId,
                        'publisherId'    => $publisherId,
                        'supportsMacros' => $supportsMacros,
                        'tagText'        => $tagText,
                    ];
                }
            }
        );
    }
}
