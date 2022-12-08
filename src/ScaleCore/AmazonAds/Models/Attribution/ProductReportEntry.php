<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

final class ProductReportEntry extends BaseModel
{
    use JsonSerialize;

    /**
     * Date on which the events took place, received in the form of "YYYYMMDD".
     */
    #[Json]
    public ?ReportDateTime $date;

    /**
     * Name of the advertiser's brand.
     */
    #[Json]
    public ?string $brandName;

    /**
     * The Amazon-owned site the product is sold on.
     */
    #[Json]
    public ?string $marketplace;

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
     * A unique block of letters and/or numbers that identify all products sold on Amazon.
     */
    #[Json]
    public ?string $productAsin;

    /**
     * The name of the product.
     */
    #[Json]
    public ?string $productName;

    /**
     * The conversion type describes whether the conversion happened on a promoted or a brand halo ASIN.
     */
    #[Json]
    public ?string $productConversionType;

    /**
     * A classification for the type of product being sold which determines its place in the Amazon retail catalog.
     * Contains categories of products.
     */
    #[Json]
    public ?string $productCategory;

    /**
     * A classification for the type of product being sold which determines its place in the Amazon retail catalog.
     * Contains subcategories of products.
     */
    #[Json]
    public ?string $productSubcategory;

    /**
     * A distinct product grouping distinguishing products like watches from video games from toys.
     * Contains groups of products.
     */
    #[Json]
    public ?string $productGroup;

    /**
     * The publisher name.
     */
    #[Json]
    public ?string $publisher;

    /**
     * Ad click-attributed detail page views for promoted products.
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
     * Ad click-attributed detail page views for brand halo products.
     */
    #[Json]
    public ?string $brandHaloDetailPageViewsClicks14d;

    /**
     * Ad click-attributed add to carts for brand halo products.
     */
    #[Json]
    public ?string $brandHaloAttributedAddToCartClicks14d;

    /**
     * Ad click-attributed purchases for brand halo products.
     */
    #[Json]
    public ?string $brandHaloAttributedPurchases14d;

    /**
     * Ad click-attributed units sold for brand halo products.
     */
    #[Json]
    public ?string $brandHaloUnitsSold14d;

    /**
     * Ad click-attributed attributed sales for brand halo products.
     */
    #[Json]
    public ?string $brandHaloAttributedSales14d;

    /**
     * Ad click-attributed new-to-brand purchases for promoted products.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    public ?string $attributedNewToBrandPurchases14d;

    /**
     * Ad click-attributed units sold in new-to-brand purchases for promoted products.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    public ?string $attributedNewToBrandUnitsSold14d;

    /**
     * Ad click-attributed sales of new-to-brand purchases for promoted products in local currency.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    public ?string $attributedNewToBrandSales14d;

    /**
     * Ad click-attributed new-to-brand purchases for brand halo products.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    public ?string $brandHaloNewToBrandPurchases14d;

    /**
     * Ad click-attributed units sold in new-to-brand purchases for brand halo products.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    public ?string $brandHaloNewToBrandUnitsSold14d;

    /**
     * Ad click-attributed sales of new-to-brand purchases for brand halo products in local currency.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    public ?string $brandHaloNewToBrandSales14d;
}
