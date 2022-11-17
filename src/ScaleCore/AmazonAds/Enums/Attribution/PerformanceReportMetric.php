<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Attribution;

use ScaleCore\AmazonAds\Concerns\GetsAllEnumCases;
use ScaleCore\AmazonAds\Concerns\GetsEnumValue;
use ScaleCore\AmazonAds\Contracts\Attribution\ReportMetricInterface;
use function ScaleCore\AmazonAds\Helpers\tap;

/**
 * @implements ReportMetricInterface<array-key, PerformanceReportMetric>
 */
enum PerformanceReportMetric: string implements ReportMetricInterface
{
    /** @use GetsAllEnumCases<array-key, PerformanceReportMetric> */
    use GetsAllEnumCases;
    use GetsEnumValue;

    case CLICK_THROUGHS                                = 'Click-throughs';
    case ATTRIBUTED_DETAIL_PAGE_VIEWS_CLICKS_14D       = 'attributedDetailPageViewsClicks14d';
    case ATTRIBUTED_ADD_TO_CART_CLICKS_14D             = 'attributedAddToCartClicks14d';
    case ATTRIBUTED_PURCHASES_14D                      = 'attributedPurchases14d';
    case UNITS_SOLD_14D                                = 'unitsSold14d';
    case ATTRIBUTED_SALES_14D                          = 'attributedSales14d';
    case ATTRIBUTED_TOTAL_DETAIL_PAGE_VIEWS_CLICKS_14D = 'attributedTotalDetailPageViewsClicks14d';
    case ATTRIBUTED_TOTAL_ADD_TO_CART_CLICKS_14D       = 'attributedTotalAddToCartClicks14d';
    case ATTRIBUTED_TOTAL_PURCHASES_14D                = 'attributedTotalPurchases14d';
    case TOTAL_UNITS_SOLD14D                           = 'totalUnitsSold14d';
    case TOTAL_ATTRIBUTED_SALES_14D                    = 'totalAttributedSales14d';
    case BRB_BONUS_AMOUNT                              = 'brb_bonus_amount';

    public function description(): string
    {
        return match ($this) {
            self::CLICK_THROUGHS                                => 'Ad clicks.',
            self::ATTRIBUTED_DETAIL_PAGE_VIEWS_CLICKS_14D       => 'Ad click-attributed detail page views for promoted product.',
            self::ATTRIBUTED_ADD_TO_CART_CLICKS_14D             => 'Ad click-attributed add to carts for promoted products.',
            self::ATTRIBUTED_PURCHASES_14D                      => 'Ad click-attributed purchases for promoted products.',
            self::UNITS_SOLD_14D                                => 'Ad click-attributed units sold for promoted products.',
            self::ATTRIBUTED_SALES_14D                          => 'Ad click-attributed sales for promoted products in local currency.',
            self::ATTRIBUTED_TOTAL_DETAIL_PAGE_VIEWS_CLICKS_14D => 'Ad click-attributed detail page views for promoted products plus brand halo products.',
            self::ATTRIBUTED_TOTAL_ADD_TO_CART_CLICKS_14D       => 'Ad click-attributed add to carts for promoted products plus brand halo products.',
            self::ATTRIBUTED_TOTAL_PURCHASES_14D                => 'Ad click-attributed purchases for promoted products plus brand halo products.',
            self::TOTAL_UNITS_SOLD14D                           => 'Ad click-attributed units sold for promoted products plus brand halo products.',
            self::TOTAL_ATTRIBUTED_SALES_14D                    => 'Ad click-attributed attributed sales for promoted products plus brand halo products.',
            self::BRB_BONUS_AMOUNT                              => 'Estimated ad-attributed Brand Referral Bonus credit amount in local currency.',
        };
    }

    /**
     * @return array<array-key, PerformanceReportMetric>
     */
    public static function allForCreativeGroupBy(): array
    {
        return tap(
            [],
            function (array &$cases): void {
                foreach (self::cases() as $case) {
                    if ($case === self::BRB_BONUS_AMOUNT) {
                        continue;
                    }

                    $cases[] = $case;
                }
            }
        );
    }
}
