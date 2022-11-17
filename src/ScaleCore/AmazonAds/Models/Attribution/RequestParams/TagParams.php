<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution\RequestParams;

use ScaleCore\AmazonAds\Models\RequestParams;

final class TagParams extends RequestParams
{
    /**
     * {@inheritdoc}
     *
     * @var array<string, mixed>
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
     * @param string[] $publisherIds
     */
    public function addPublisherIds(array $publisherIds): self
    {
        $publisherIds = (fn (string ...$publisherIds) => $publisherIds)(...$publisherIds);

        foreach ($publisherIds as $publisherId) {
            $this->addPublisherId($publisherId);
        }

        return $this;
    }

    public function addPublisherId(string $publisherId): self
    {
        $this->params['publisherIds'][] = $publisherId;

        return $this;
    }

    /**
     * @param string[] $advertiserIds
     */
    public function addAdvertiserIds(array $advertiserIds): self
    {
        $advertiserIds = (fn (string ...$ids) => $ids)(...$advertiserIds);

        foreach ($advertiserIds as $advertiserId) {
            $this->addAdvertiserId($advertiserId);
        }

        return $this;
    }

    public function addAdvertiserId(string $advertiserId): self
    {
        $this->params['advertiserIds'][] = $advertiserId;

        return $this;
    }
}
