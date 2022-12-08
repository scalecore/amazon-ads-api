<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums\Attribution;

use ScaleCore\AmazonAds\Concerns\GetsAllEnumCases;
use ScaleCore\AmazonAds\Concerns\GetsEnumValue;
use ScaleCore\AmazonAds\Contracts\Attribution\ReportMetricInterface;

/**
 * @implements ReportMetricInterface<array-key, ProductReportMetric>
 */
enum ProductReportMetric: string implements ReportMetricInterface
{
    /**
     * @use GetsAllEnumCases<array-key, ProductReportMetric>
     */
    use GetsAllEnumCases;
    use GetsEnumValue;

    case ATTRIBUTED_DETAIL_PAGE_VIEWS_CLICKS_14D      = 'attributedDetailPageViewsClicks14d';
    case ATTRIBUTED_ADD_TO_CART_CLICKS_14D            = 'attributedAddToCartClicks14d';
    case ATTRIBUTED_PURCHASES_14D                     = 'attributedPurchases14d';
    case UNITS_SOLD_14D                               = 'unitsSold14d';
    case ATTRIBUTED_SALES_14D                         = 'attributedSales14d';
    case BRAND_HALO_DETAIL_PAGE_VIEWS_CLICKS_14D      = 'brandHaloDetailPageViewsClicks14d';
    case BRAND_HALO_ATTRIBUTED_ADD_TO_CART_CLICKS_14D = 'brandHaloAttributedAddToCartClicks14d';
    case BRAND_HALO_ATTRIBUTED_PURCHASES_14D          = 'brandHaloAttributedPurchases14d';
    case BRAND_HALO_UNITS_SOLD_14D                    = 'brandHaloUnitsSold14d';
    case BRAND_HALO_ATTRIBUTED_SALES_14D              = 'brandHaloAttributedSales14d';
    case ATTRIBUTED_NEW_TO_BRAND_PURCHASES_14D        = 'attributedNewToBrandPurchases14d';
    case ATTRIBUTED_NEW_TO_BRAND_UNITS_SOLD_14D       = 'attributedNewToBrandUnitsSold14d';
    case ATTRIBUTED_NEW_TO_BRAND_SALES_14D            = 'attributedNewToBrandSales14d';
    case BRAND_HALO_NEW_TO_BRAND_PURCHASES_14D        = 'brandHaloNewToBrandPurchases14d';
    case BRAND_HALO_NEW_TO_BRAND_UNITS_SOLD_14D       = 'brandHaloNewToBrandUnitsSold14d';
    case BRAND_HALO_NEW_TO_BRAND_SALES_14D            = 'brandHaloNewToBrandSales14d';

    public function description(): string
    {
        return match ($this) {
            self::ATTRIBUTED_DETAIL_PAGE_VIEWS_CLICKS_14D      => 'Ad click-attributed detail page views for promoted products.',
            self::ATTRIBUTED_ADD_TO_CART_CLICKS_14D            => 'Ad click-attributed add to carts for promoted products.',
            self::ATTRIBUTED_PURCHASES_14D                     => 'Ad click-attributed purchases for promoted products.',
            self::UNITS_SOLD_14D                               => 'Ad click-attributed units sold for promoted products.',
            self::ATTRIBUTED_SALES_14D                         => 'Ad click-attributed sales for promoted products in local currency.',
            self::BRAND_HALO_DETAIL_PAGE_VIEWS_CLICKS_14D      => 'Ad click-attributed detail page views for brand halo products.',
            self::BRAND_HALO_ATTRIBUTED_ADD_TO_CART_CLICKS_14D => 'Ad click-attributed add to carts for brand halo products.',
            self::BRAND_HALO_ATTRIBUTED_PURCHASES_14D          => 'Ad click-attributed purchases for brand halo products.',
            self::BRAND_HALO_UNITS_SOLD_14D                    => 'Ad click-attributed units sold for brand halo products.',
            self::BRAND_HALO_ATTRIBUTED_SALES_14D              => 'Ad click-attributed attributed sales for brand halo products.',
            self::ATTRIBUTED_NEW_TO_BRAND_PURCHASES_14D        => 'Ad click-attributed new-to-brand purchases for promoted products.',
            self::ATTRIBUTED_NEW_TO_BRAND_UNITS_SOLD_14D       => 'Ad click-attributed units sold in new-to-brand purchases for promoted products.',
            self::ATTRIBUTED_NEW_TO_BRAND_SALES_14D            => 'Ad click-attributed sales of new-to-brand purchases for promoted products in local currency.',
            self::BRAND_HALO_NEW_TO_BRAND_PURCHASES_14D        => 'Ad click-attributed new-to-brand purchases for brand halo products.',
            self::BRAND_HALO_NEW_TO_BRAND_UNITS_SOLD_14D       => 'Ad click-attributed units sold in new-to-brand purchases for brand halo products.',
            self::BRAND_HALO_NEW_TO_BRAND_SALES_14D            => 'Ad click-attributed sales of new-to-brand purchases for brand halo products in local currency.',
        };
    }
}
