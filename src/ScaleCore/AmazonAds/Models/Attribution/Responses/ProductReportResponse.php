<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\Responses;

use ScaleCore\AmazonAds\Models\Attribution\ProductReportEntry;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class ProductReportResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * Array of ProductReportEntry objects.
     *
     * @var array<array-key, ProductReportEntry>|null
     */
    #[Json(type: ProductReportEntry::class)]
    public ?array $reports;

    /**
     * The size of the report.
     */
    #[Json]
    public ?int $count;

    /**
     * The identifier of the pagination cursor.
     */
    #[Json]
    public ?string $cursorId;
}
