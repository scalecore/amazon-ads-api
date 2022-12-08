<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\RequestBodies;

use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\ManagerAccounts\ManagerAccountType;
use ScaleCore\AmazonAds\Models\BaseRequestBody;

/**
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @template-extends BaseRequestBody<TKey, TValue>
 */
final class CreateManagerAccountRequest extends BaseRequestBody implements HttpRequestBodyInterface
{
    public function __construct(
        private readonly string $managerAccountName,
        private readonly ManagerAccountType $managerAccountType
    ) {
    }

    /**
     * Get the instance as an array.
     *
     * @return array<TKey, string>
     */
    public function toArray(): array
    {
        return [
            'managerAccountName' => $this->managerAccountName,
            'managerAccountType' => $this->managerAccountType->value,
        ];
    }
}
