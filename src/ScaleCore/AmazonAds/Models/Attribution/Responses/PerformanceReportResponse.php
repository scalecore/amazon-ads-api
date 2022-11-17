<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\Responses;

use ScaleCore\AmazonAds\Models\Attribution\PerformanceReportEntry;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property array<array-key, PerformanceReportEntry>|null $reports
 * @property int|null                                      $count
 * @property string|null                                   $cursorId
 */
final class PerformanceReportResponse extends BaseModel
{
    use JsonSerialize;

    /**
     * Array of PerformanceReportEntry objects.
     *
     * @var array<array-key, PerformanceReportEntry>|null
     */
    #[Json(type: PerformanceReportEntry::class)]
    protected ?array $reports;

    /**
     * The size of the report.
     */
    #[Json]
    protected ?int $count;

    /**
     * The identifier of the pagination cursor.
     */
    #[Json]
    protected ?string $cursorId;
}
