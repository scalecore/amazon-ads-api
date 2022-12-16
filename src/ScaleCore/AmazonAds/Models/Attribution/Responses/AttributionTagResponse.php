<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\Responses;

use ScaleCore\AmazonAds\Helpers\Cast;
use function ScaleCore\AmazonAds\Helpers\tap;
use ScaleCore\AmazonAds\Models\Attribution\AttributionTagMap;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class AttributionTagResponse extends BaseModel
{
    use JsonSerialize {
        fromJsonData as traitFromJsonData;
    }

    /** @var array<array-key, AttributionTagMap>|null */
    #[Json(type: AttributionTagMap::class)]
    public ?array $attributionTagMaps;

    /**
     * @param object|array<array-key, mixed>|string $properties
     *
     * @throws \JsonException
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
     * @param array<array-key, mixed>         $jd
     * @param array<array-key, string>|string $path
     */
    public static function fromJsonData($jd, array|string $path = [], bool $supportsMacros = true): static
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
