<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Enums\Attribution\PerformanceReportGroupBy;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property PerformanceReportGroupBy|null $groupBy
 * @property string|null                   $date
 * @property string|null                   $advertiserName
 * @property string|null                   $campaignId
 * @property string|null                   $adGroupId
 * @property string|null                   $creativeId
 * @property string|null                   $publisher
 * @property string|null                   $clickThroughs
 * @property string|null                   $Click-throughs
 * @property string|null                   $attributedDetailPageViewsClicks14d
 * @property string|null                   $attributedAddToCartClicks14d
 * @property string|null                   $attributedPurchases14d
 * @property string|null                   $unitsSold14d
 * @property string|null                   $attributedSales14d
 * @property string|null                   $attributedTotalDetailPageViewsClicks14d
 * @property string|null                   $attributedTotalAddToCartClicks14d
 * @property string|null                   $attributedTotalPurchases14d
 * @property string|null                   $totalUnitsSold14d
 * @property string|null                   $totalAttributedSales14d
 * @property string|null                   $brbBonusAmount
 * @property string|null                   $brb_bonus_amount
 */
final class PerformanceReportEntry extends BaseModel
{
    use JsonSerialize;

    /**
     * Level of aggregation.
     */
    #[Json]
    protected ?PerformanceReportGroupBy $groupBy;

    /**
     * Date on which the events took place, form as "YYYYMMDD".
     */
    #[Json]
    protected ?string $date;

    /**
     * Name of advertiser.
     */
    #[Json]
    protected ?string $advertiserName;

    /**
     * A campaign external identifier.
     */
    #[Json]
    protected ?string $campaignId;

    /**
     * An ad group external identifier.
     */
    #[Json]
    protected ?string $adGroupId;

    /**
     * A creative external identifier.
     */
    #[Json]
    protected ?string $creativeId;

    /**
     * The publisher name.
     */
    #[Json]
    protected ?string $publisher;

    /**
     * Ad clicks.
     */
    #[Json('Click-throughs')]
    protected ?string $clickThroughs;

    /**
     * Ad click-attributed detail page views for promoted product.
     */
    #[Json]
    protected ?string $attributedDetailPageViewsClicks14d;

    /**
     * Ad click-attributed add to carts for promoted products.
     */
    #[Json]
    protected ?string $attributedAddToCartClicks14d;

    /**
     * Ad click-attributed purchases for promoted products.
     */
    #[Json]
    protected ?string $attributedPurchases14d;

    /**
     * Ad click-attributed units sold for promoted products.
     */
    #[Json]
    protected ?string $unitsSold14d;

    /**
     * Ad click-attributed sales for promoted products in local currency.
     */
    #[Json]
    protected ?string $attributedSales14d;

    /**
     * Ad click-attributed detail page views for promoted products plus brand halo products.
     */
    #[Json]
    protected ?string $attributedTotalDetailPageViewsClicks14d;

    /**
     * Ad click-attributed add to carts for promoted products plus brand halo products.
     */
    #[Json]
    protected ?string $attributedTotalAddToCartClicks14d;

    /**
     * Ad click-attributed purchases for promoted products plus brand halo products.
     */
    #[Json]
    protected ?string $attributedTotalPurchases14d;

    /**
     * Ad click-attributed units sold for promoted products plus brand halo products.
     */
    #[Json]
    protected ?string $totalUnitsSold14d;

    /**
     * Ad click-attributed attributed sales for promoted products plus brand halo products.
     */
    #[Json]
    protected ?string $totalAttributedSales14d;

    /**
     * Estimated ad-attributed Brand Referral Bonus credit amount in local currency.
     *
     * Will be omitted from response if advertiser is not a BRB-enrolled seller
     * or request does not include a ‘metrics’ list.
     *
     * Requests for this metric must groupBy ADGROUP or CAMPAIGN, or will result in an error 400.
     * Please refer to https://sellercentral.amazon.com/gp/help/external/L9HPJ34VBFP76HX
     * to learn more about BRB program.
     */
    #[Json('brb_bonus_amount')]
    protected ?string $brbBonusAmount;

    public function __get(string $name): mixed
    {
        if ($name === 'Click-throughs') {
            return $this->clickThroughs;
        }

        if ($name === 'brb_bonus_amount') {
            return $this->brbBonusAmount;
        }

        return parent::__get($name);
    }

    public function setGroupBy(?PerformanceReportGroupBy $groupBy): void
    {
        $this->groupBy = $groupBy;
    }
}
