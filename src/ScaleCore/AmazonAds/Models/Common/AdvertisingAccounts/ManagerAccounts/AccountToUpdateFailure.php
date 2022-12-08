<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class AccountToUpdateFailure extends BaseModel
{
    use JsonSerialize;

    /**
     * The error response object.
     */
    #[Json]
    public ?ErrorDetail $error;

    /**
     * Object representation of an Amazon Advertising account or DSP advertiser that failed to update.
     */
    #[Json]
    public ?AccountToUpdate $account;
}
