<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\Responses;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class CreateOrUpdatePortfoliosResponse extends BaseModel
{
    use JsonSerialize {
        fromJsonData as traitFromJsonData;
    }

    /**
     * Array of PortfolioResponse objects.
     *
     * @var array<array-key, PortfolioResponse>|null
     */
    #[Json(type: PortfolioResponse::class)]
    public ?array $portfolios;

    /**
     * @param array<array-key, mixed>         $jd
     * @param array<array-key, string>|string $path
     */
    public static function fromJsonData($jd, array|string $path = []): static
    {
        return static::traitFromJsonData(['portfolios' => $jd], $path);
    }
}
