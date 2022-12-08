<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\RequestBodies;

use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
use ScaleCore\AmazonAds\Models\BaseRequestBody;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\AccountToUpdate;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts\AccountToUpdateList;

/**
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @template-extends BaseRequestBody<TKey, TValue>
 */
final class UpdateAdvertisingAccountsInManagerAccountRequest extends BaseRequestBody implements HttpRequestBodyInterface
{
    private const MIN_ACCOUNT_COUNT = 1;
    private const MAX_ACCOUNT_COUNT = 20;

    public function __construct(private readonly AccountToUpdateList $accounts)
    {
        $this->validateAccountsToUpdate();
    }

    /**
     * Get the instance as an array.
     *
     * @return array<TKey, object>
     */
    public function toArray(): array
    {
        return \array_map(
            function (AccountToUpdate $accountToUpdate): object {
                return (object) [
                    'id'    => $accountToUpdate->id,
                    'type'  => $accountToUpdate->type->value ?? '',
                    'roles' => [$accountToUpdate->roles[0]->value ?? ''],
                ];
            },
            $this->accounts->toArray()
        );
    }

    private function validateAccountsToUpdate(): void
    {
        $count = $this->accounts->count();
        if ($count < self::MIN_ACCOUNT_COUNT || $count > self::MAX_ACCOUNT_COUNT) {
            throw new \LengthException(
                sprintf(
                    'The associate/disassociate to manager account operation is limited to between %s and %s accounts, %s provided.',
                    self::MIN_ACCOUNT_COUNT,
                    self::MAX_ACCOUNT_COUNT,
                    $count
                )
            );
        }
    }
}
