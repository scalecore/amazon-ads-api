<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios;

use ScaleCore\AmazonAds\Contracts\Arrayable;

/**
 * @implements Arrayable<array-key, Portfolio>
 */
final class PortfolioList implements Arrayable
{
    /** @var array<array-key, Portfolio> */
    private array $portfolios;

    /**
     * @param array<array-key, Portfolio> $portfolios
     */
    public function __construct(array $portfolios = [])
    {
        $this->addPortfolios($portfolios);
    }

    /**
     * @param array<array-key, Portfolio> $portfolios
     */
    public function addPortfolios(array $portfolios): self
    {
        foreach ($portfolios as $portfolio) {
            $this->addPortfolio($portfolio);
        }

        return $this;
    }

    public function addPortfolio(Portfolio $portfolio): self
    {
        $this->portfolios[] = $portfolio;

        return $this;
    }

    /**
     * Get the instance as an array.
     *
     * @return array<array-key, Portfolio>
     */
    public function toArray(): array
    {
        return $this->portfolios;
    }
}
