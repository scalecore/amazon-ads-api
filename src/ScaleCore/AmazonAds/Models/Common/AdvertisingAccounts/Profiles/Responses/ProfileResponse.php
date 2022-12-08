<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\Responses;

use ScaleCore\AmazonAds\Models\MutationResponse;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class ProfileResponse extends MutationResponse
{
    use JsonSerialize;

    /**
     * The ID of the profile that was updated, if successful.
     */
    #[Json]
    public ?int $profileId;

    /**
     * A human-readable string of the update details.
     */
    #[Json]
    public ?string $details;
}
