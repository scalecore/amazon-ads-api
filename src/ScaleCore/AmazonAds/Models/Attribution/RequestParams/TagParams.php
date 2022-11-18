<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\RequestParams;

use ScaleCore\AmazonAds\Helpers\Cast;
use ScaleCore\AmazonAds\Models\RequestParams;

final class TagParams extends RequestParams
{
    /**
     * {@inheritdoc}
     *
     * @var array<string, array<array-key, string>>
     */
    protected array $params = [
        'publisherIds'  => [],
        'advertiserIds' => [],
    ];

    /**
     * {@inheritdoc}
     *
     * @var array<string, string>
     */
    protected array $map = [
        'publisherIds'  => 'addPublisherIds',
        'advertiserIds' => 'addAdvertiserIds',
    ];

    /**
     * {@inheritdoc}
     *
     * @var array<int, string>
     */
    protected array $filters = [
        'publisherIds',
        'advertiserIds',
    ];

    /**
     * @param array<array-key, string|int> $publisherIds
     */
    public function addPublisherIds(array $publisherIds): self
    {
        $publisherIds = (fn (string|int ...$publisherIds) => $publisherIds)(...$publisherIds);

        foreach ($publisherIds as $publisherId) {
            $this->addPublisherId($publisherId);
        }

        return $this;
    }

    public function addPublisherId(string|int $publisherId): self
    {
        $this->params['publisherIds'][] = Cast::toString($publisherId);

        return $this;
    }

    /**
     * @param array<array-key, string|int> $advertiserIds
     */
    public function addAdvertiserIds(array $advertiserIds): self
    {
        $advertiserIds = (fn (string|int ...$ids) => $ids)(...$advertiserIds);

        foreach ($advertiserIds as $advertiserId) {
            $this->addAdvertiserId($advertiserId);
        }

        return $this;
    }

    public function addAdvertiserId(string|int $advertiserId): self
    {
        $this->params['advertiserIds'][] = Cast::toString($advertiserId);

        return $this;
    }
}
