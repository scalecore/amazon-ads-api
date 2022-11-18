<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\Responses;

use ScaleCore\AmazonAds\Models\Attribution\PerformanceReportEntry;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class PerformanceReportResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * Array of PerformanceReportEntry objects.
     *
     * @var array<array-key, PerformanceReportEntry>|null
     */
    #[Json(type: PerformanceReportEntry::class)]
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
