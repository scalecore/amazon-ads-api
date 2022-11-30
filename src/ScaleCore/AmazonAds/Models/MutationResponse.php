<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use Square\Pjson\Json;

abstract class MutationResponse extends BaseModel
{
    /**
     * An enumerated success or error code for machine use.
     */
    #[Json]
    public ?string $code;

    /**
     * A human-readable description of the error, if unsuccessful.
     */
    #[Json]
    public ?string $description;
}
