<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Common\Portfolios\RequestParams;

use ScaleCore\AmazonAds\Enums\Common\Portfolio\PortfolioState;
use ScaleCore\AmazonAds\Helpers\Cast;
use ScaleCore\AmazonAds\Models\RequestParams;

final class GetPortfoliosParams extends RequestParams
{
    /**
     * {@inheritdoc}
     *
     * @var array<string, array<array-key, string>>
     */
    protected array $params = [
        'portfolioIdFilter'    => [],
        'portfolioNameFilter'  => [],
        'portfolioStateFilter' => [],
    ];

    /**
     * {@inheritdoc}
     *
     * @var array<string, string>
     */
    protected array $map = [
        'portfolioIdFilter'    => 'addPortfolioIds',
        'portfolioNameFilter'  => 'addPortfolioNames',
        'portfolioStateFilter' => 'addPortfolioStates',
    ];

    /**
     * {@inheritdoc}
     *
     * @var array<int, string>
     */
    protected array $filters = [
        'portfolioIdFilter',
        'portfolioNameFilter',
        'portfolioStateFilter',
    ];

    /**
     * @param array<array-key, int> $portfolioIds
     */
    protected function addPortfolioIds(array $portfolioIds): self
    {
        $portfolioIds = (fn (int ...$portfolioIds) => $portfolioIds)(...$portfolioIds);

        if (\count($portfolioIds) > 100) {
            throw new \LengthException(
                sprintf(
                    'Portfolio ID filter cannot contain more than 100 entries, %s entries provided.',
                    \count($portfolioIds)
                )
            );
        }

        foreach ($portfolioIds as $portfolioId) {
            $this->params['portfolioIdFilter'][] = Cast::toString($portfolioId);
        }

        return $this;
    }

    /**
     * @param array<array-key, string> $portfolioNames
     */
    protected function addPortfolioNames(array $portfolioNames): self
    {
        $portfolioNames = (fn (string ...$portfolioNames) => $portfolioNames)(...$portfolioNames);

        if (\count($portfolioNames) > 100) {
            throw new \LengthException(
                sprintf(
                    'Portfolio Name filter cannot contain more than 100 entries, %s entries provided.',
                    \count($portfolioNames)
                )
            );
        }

        foreach ($portfolioNames as $portfolioName) {
            $this->params['portfolioNameFilter'][] = $portfolioName;
        }

        return $this;
    }

    /**
     * @param array<array-key, PortfolioState> $portfolioStates
     */
    protected function addPortfolioStates(array $portfolioStates): self
    {
        $portfolioStates = (fn (PortfolioState ...$portfolioStates) => $portfolioStates)(...$portfolioStates);

        foreach ($portfolioStates as $portfolioState) {
            $this->params['portfolioStateFilter'][] = $portfolioState->value;
        }

        return $this;
    }
}
