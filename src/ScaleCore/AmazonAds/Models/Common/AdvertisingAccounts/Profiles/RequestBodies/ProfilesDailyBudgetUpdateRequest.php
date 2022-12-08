<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\RequestBodies;

use ScaleCore\AmazonAds\Contracts\HttpRequestBodyInterface;
use ScaleCore\AmazonAds\Models\BaseRequestBody;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\Profile;
use ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\ProfileList;

/**
 * @template TKey of array-key
 * @template TValue of mixed
 *
 * @template-extends BaseRequestBody<TKey, TValue>
 */
final class ProfilesDailyBudgetUpdateRequest extends BaseRequestBody implements HttpRequestBodyInterface
{
    private const MIN_PROFILE_COUNT = 1;

    public function __construct(private readonly ProfileList $profiles)
    {
        $this->validateProfiles();
    }

    /**
     * Get the instance as an array.
     *
     * @return array<TKey, object>
     */
    public function toArray(): array
    {
        return \array_map(
            function (Profile $profile): object {
                return (object) [
                    'profileId'   => $profile->profileId,
                    'dailyBudget' => $profile->dailyBudget,
                ];
            },
            $this->profiles->toArray()
        );
    }

    private function validateProfiles(): void
    {
        $count = $this->profiles->count();
        if ($count < self::MIN_PROFILE_COUNT) {
            throw new \LengthException(
                sprintf(
                    'The profile daily budget update operation must contain at least %s Profile, %s provided.',
                    self::MIN_PROFILE_COUNT,
                    $count
                )
            );
        }

        foreach ($this->profiles->toArray() as $profile) {
            if ($profile->profileId === null) {
                throw new \DomainException('Profile daily budget update requires `profileId` to be valid value, `null` provided.');
            }

            if ($profile->dailyBudget === null) {
                throw new \DomainException('Profile daily budget update requires `dailyBudget` to be valid value, `null` provided.');
            }
        }
    }
}
