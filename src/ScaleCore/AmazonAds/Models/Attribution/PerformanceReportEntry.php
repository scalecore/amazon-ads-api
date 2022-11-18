<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Enums\Attribution\PerformanceReportGroupBy;
use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property string|null $Click-throughs
 * @property string|null $brb_bonus_amount
 */
final class PerformanceReportEntry extends BaseModel
{
    use JsonSerialize;

    /**
     * Level of aggregation.
     */
    #[Json]
    public ?PerformanceReportGroupBy $groupBy;

    /**
     * Date on which the events took place, form as "YYYYMMDD".
     */
    #[Json]
    public ?string $date;

    /**
     * Name of advertiser.
     */
    #[Json]
    public ?string $advertiserName;

    /**
     * A campaign external identifier.
     */
    #[Json]
    public ?string $campaignId;

    /**
     * An ad group external identifier.
     */
    #[Json]
    public ?string $adGroupId;

    /**
     * A creative external identifier.
     */
    #[Json]
    public ?string $creativeId;

    /**
     * The publisher name.
     */
    #[Json]
    public ?string $publisher;

    /**
     * Ad clicks.
     */
    #[Json('Click-throughs')]
    public ?string $clickThroughs;

    /**
     * Ad click-attributed detail page views for promoted product.
     */
    #[Json]
    public ?string $attributedDetailPageViewsClicks14d;

    /**
     * Ad click-attributed add to carts for promoted products.
     */
    #[Json]
    public ?string $attributedAddToCartClicks14d;

    /**
     * Ad click-attributed purchases for promoted products.
     */
    #[Json]
    public ?string $attributedPurchases14d;

    /**
     * Ad click-attributed units sold for promoted products.
     */
    #[Json]
    public ?string $unitsSold14d;

    /**
     * Ad click-attributed sales for promoted products in local currency.
     */
    #[Json]
    public ?string $attributedSales14d;

    /**
     * Ad click-attributed detail page views for promoted products plus brand halo products.
     */
    #[Json]
    public ?string $attributedTotalDetailPageViewsClicks14d;

    /**
     * Ad click-attributed add to carts for promoted products plus brand halo products.
     */
    #[Json]
    public ?string $attributedTotalAddToCartClicks14d;

    /**
     * Ad click-attributed purchases for promoted products plus brand halo products.
     */
    #[Json]
    public ?string $attributedTotalPurchases14d;

    /**
     * Ad click-attributed units sold for promoted products plus brand halo products.
     */
    #[Json]
    public ?string $totalUnitsSold14d;

    /**
     * Ad click-attributed attributed sales for promoted products plus brand halo products.
     */
    #[Json]
    public ?string $totalAttributedSales14d;

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
    public ?string $brbBonusAmount;

    public function __get(string $name): mixed
    {
        if ($name === 'Click-throughs') {
            return $this->clickThroughs;
        }

        if ($name === 'brb_bonus_amount') {
            return $this->brbBonusAmount;
        }

        if ( ! \property_exists($this, $name)) {
            \trigger_error('Undefined property: ' . \get_class($this) . '::$' . $name, E_USER_ERROR);
        }

        return $this->$name;
    }
}
