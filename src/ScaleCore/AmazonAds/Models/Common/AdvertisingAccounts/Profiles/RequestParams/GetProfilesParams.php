<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\AdvertisingAccounts\Profiles\RequestParams;

use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles\AccessLevel;
use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles\AccountType;
use ScaleCore\AmazonAds\Enums\Common\AdvertisingAccounts\Profiles\ApiProgram;
use ScaleCore\AmazonAds\Models\RequestParams;

final class GetProfilesParams extends RequestParams
{
    /**
     * {@inheritdoc}
     *
     * @var array<string, mixed>
     */
    protected array $params = [
        'apiProgram'               => null,
        'accessLevel'              => null,
        'profileTypeFilter'        => null,
        'validPaymentMethodFilter' => null,
    ];

    /**
     * {@inheritdoc}
     *
     * @var array<string, string>
     */
    protected array $map = [
        'apiProgram'               => 'setApiProgram',
        'accessLevel'              => 'setAccessLevel',
        'profileTypeFilter'        => 'setProfileTypeFilter',
        'validPaymentMethodFilter' => 'setValidPaymentMethodFilter',
    ];

    public function setApiProgram(?ApiProgram $apiProgram): self
    {
        $this->params['apiProgram'] = $apiProgram;

        return $this;
    }

    public function setAccessLevel(?AccessLevel $accessLevel): self
    {
        $this->params['accessLevel'] = $accessLevel;

        return $this;
    }

    public function setProfileTypeFilter(?AccountType $profileTypeFilter): self
    {
        $this->params['profileTypeFilter'] = $profileTypeFilter;

        return $this;
    }

    public function setValidPaymentMethodFilter(?bool $validPaymentMethodFilter): self
    {
        $this->params['validPaymentMethodFilter'] = $validPaymentMethodFilter;

        return $this;
    }
}
