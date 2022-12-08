<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles;

use ScaleCore\AmazonAds\Contracts\Arrayable;

/**
 * @implements Arrayable<array-key, Profile>
 */
final class ProfileList implements Arrayable
{
    /** @var array<array-key, Profile> */
    private array $profiles = [];

    /**
     * @param array<array-key, Profile> $profiles
     */
    public function __construct(array $profiles = [])
    {
        $this->addProfiles($profiles);
    }

    /**
     * @param array<array-key, Profile> $profiles
     */
    public function addProfiles(array $profiles): self
    {
        foreach ($profiles as $profile) {
            $this->addProfile($profile);
        }

        return $this;
    }

    public function addProfile(Profile $profile): self
    {
        $this->profiles[] = $profile;

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array<array-key, Profile>
     */
    public function toArray(): array
    {
        return $this->profiles;
    }

    public function count(): int
    {
        return \count($this->profiles);
    }
}
