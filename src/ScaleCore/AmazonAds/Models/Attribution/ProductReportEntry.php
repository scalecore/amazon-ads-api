<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models\Attribution;

use ScaleCore\AmazonAds\Models\BaseModel;
use Square\Pjson\Json;
use Square\Pjson\JsonSerialize;

/**
 * @property string|null $date
 * @property string|null $brandName
 * @property string|null $marketplace
 * @property string|null $advertiserName
 * @property string|null $campaignId
 * @property string|null $adGroupId
 * @property string|null $productAsin
 * @property string|null $productName
 * @property string|null $productConversionType
 * @property string|null $productCategory
 * @property string|null $productSubcategory
 * @property string|null $productGroup
 * @property string|null $publisher
 * @property string|null $attributedDetailPageViewsClicks14d
 * @property string|null $attributedAddToCartClicks14d
 * @property string|null $attributedPurchases14d
 * @property string|null $unitsSold14d
 * @property string|null $attributedSales14d
 * @property string|null $brandHaloDetailPageViewsClicks14d
 * @property string|null $brandHaloAttributedAddToCartClicks14d
 * @property string|null $brandHaloAttributedPurchases14d
 * @property string|null $brandHaloUnitsSold14d
 * @property string|null $brandHaloAttributedSales14d
 * @property string|null $attributedNewToBrandPurchases14d
 * @property string|null $attributedNewToBrandUnitsSold14d
 * @property string|null $attributedNewToBrandSales14d
 * @property string|null $brandHaloNewToBrandPurchases14d
 * @property string|null $brandHaloNewToBrandUnitsSold14d
 * @property string|null $brandHaloNewToBrandSales14d
 */
final class ProductReportEntry extends BaseModel
{
    use JsonSerialize;

    /**
     * Date on which the events took place, form as "YYYYMMDD".
     */
    #[Json]
    protected ?string $date;

    /**
     * Name of the advertiser's brand.
     */
    #[Json]
    protected ?string $brandName;

    /**
     * The Amazon-owned site the product is sold on.
     */
    #[Json]
    protected ?string $marketplace;

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
     * A unique block of letters and/or numbers that identify all products sold on Amazon.
     */
    #[Json]
    protected ?string $productAsin;

    /**
     * The name of the product.
     */
    #[Json]
    protected ?string $productName;

    /**
     * The conversion type describes whether the conversion happened on a promoted or a brand halo ASIN.
     */
    #[Json]
    protected ?string $productConversionType;

    /**
     * A classification for the type of product being sold which determines its place in the Amazon retail catalog.
     * Contains categories of products.
     */
    #[Json]
    protected ?string $productCategory;

    /**
     * A classification for the type of product being sold which determines its place in the Amazon retail catalog.
     * Contains subcategories of products.
     */
    #[Json]
    protected ?string $productSubcategory;

    /**
     * A distinct product grouping distinguishing products like watches from video games from toys.
     * Contains groups of products.
     */
    #[Json]
    protected ?string $productGroup;

    /**
     * The publisher name.
     */
    #[Json]
    protected ?string $publisher;

    /**
     * Ad click-attributed detail page views for promoted products.
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
     * Ad click-attributed detail page views for brand halo products.
     */
    #[Json]
    protected ?string $brandHaloDetailPageViewsClicks14d;

    /**
     * Ad click-attributed add to carts for brand halo products.
     */
    #[Json]
    protected ?string $brandHaloAttributedAddToCartClicks14d;

    /**
     * Ad click-attributed purchases for brand halo products.
     */
    #[Json]
    protected ?string $brandHaloAttributedPurchases14d;

    /**
     * Ad click-attributed units sold for brand halo products.
     */
    #[Json]
    protected ?string $brandHaloUnitsSold14d;

    /**
     * Ad click-attributed attributed sales for brand halo products.
     */
    #[Json]
    protected ?string $brandHaloAttributedSales14d;

    /**
     * Ad click-attributed new-to-brand purchases for promoted products.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    protected ?string $attributedNewToBrandPurchases14d;

    /**
     * Ad click-attributed units sold in new-to-brand purchases for promoted products.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    protected ?string $attributedNewToBrandUnitsSold14d;

    /**
     * Ad click-attributed sales of new-to-brand purchases for promoted products in local currency.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    protected ?string $attributedNewToBrandSales14d;

    /**
     * Ad click-attributed new-to-brand purchases for brand halo products.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    protected ?string $brandHaloNewToBrandPurchases14d;

    /**
     * Ad click-attributed units sold in new-to-brand purchases for brand halo products.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    protected ?string $brandHaloNewToBrandUnitsSold14d;

    /**
     * Ad click-attributed sales of new-to-brand purchases for brand halo products in local currency.
     *
     * A purchase is new-to-brand when a shopper purchases a product
     * from the brand for the first time in the past year.
     */
    #[Json]
    protected ?string $brandHaloNewToBrandSales14d;
}
