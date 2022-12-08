<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\ManagerAccounts;

use ScaleCore\AmazonAds\Contracts\Arrayable;

/**
 * @implements Arrayable<array-key, AccountToUpdate>
 */
final class AccountToUpdateList implements Arrayable
{
    /** @var array<array-key, AccountToUpdate> */
    private array $accounts = [];

    /**
     * @param array<array-key, AccountToUpdate> $accountsToUpdate
     */
    public function __construct(array $accountsToUpdate = [])
    {
        $this->addAccountsToUpdate($accountsToUpdate);
    }

    /**
     * @param array<array-key, AccountToUpdate> $accountsToUpdate
     */
    public function addAccountsToUpdate(array $accountsToUpdate): self
    {
        foreach ($accountsToUpdate as $accountToUpdate) {
            $this->addAccountToUpdate($accountToUpdate);
        }

        return $this;
    }

    public function addAccountToUpdate(AccountToUpdate $accountToUpdate): self
    {
        $this->accounts[] = $accountToUpdate;

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array<array-key, AccountToUpdate>
     */
    public function toArray(): array
    {
        return $this->accounts;
    }

    public function count(): int
    {
        return \count($this->accounts);
    }
}
