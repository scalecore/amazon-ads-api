<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Enums\Attribution\ProductReportMetric;

test(
    'ProductReportMetric description method',
    function () {
        expect(ProductReportMetric::ATTRIBUTED_DETAIL_PAGE_VIEWS_CLICKS_14D->description())->toEqual('Ad click-attributed detail page views for promoted products.');
        expect(ProductReportMetric::ATTRIBUTED_ADD_TO_CART_CLICKS_14D->description())->toEqual('Ad click-attributed add to carts for promoted products.');
        expect(ProductReportMetric::ATTRIBUTED_PURCHASES_14D->description())->toEqual('Ad click-attributed purchases for promoted products.');
        expect(ProductReportMetric::UNITS_SOLD_14D->description())->toEqual('Ad click-attributed units sold for promoted products.');
        expect(ProductReportMetric::ATTRIBUTED_SALES_14D->description())->toEqual('Ad click-attributed sales for promoted products in local currency.');
        expect(ProductReportMetric::BRAND_HALO_DETAIL_PAGE_VIEWS_CLICKS_14D->description())->toEqual('Ad click-attributed detail page views for brand halo products.');
        expect(ProductReportMetric::BRAND_HALO_ATTRIBUTED_ADD_TO_CART_CLICKS_14D->description())->toEqual('Ad click-attributed add to carts for brand halo products.');
        expect(ProductReportMetric::BRAND_HALO_ATTRIBUTED_PURCHASES_14D->description())->toEqual('Ad click-attributed purchases for brand halo products.');
        expect(ProductReportMetric::BRAND_HALO_UNITS_SOLD_14D->description())->toEqual('Ad click-attributed units sold for brand halo products.');
        expect(ProductReportMetric::BRAND_HALO_ATTRIBUTED_SALES_14D->description())->toEqual('Ad click-attributed attributed sales for brand halo products.');
        expect(ProductReportMetric::ATTRIBUTED_NEW_TO_BRAND_PURCHASES_14D->description())->toEqual('Ad click-attributed new-to-brand purchases for promoted products.');
        expect(ProductReportMetric::ATTRIBUTED_NEW_TO_BRAND_UNITS_SOLD_14D->description())->toEqual('Ad click-attributed units sold in new-to-brand purchases for promoted products.');
        expect(ProductReportMetric::ATTRIBUTED_NEW_TO_BRAND_SALES_14D->description())->toEqual('Ad click-attributed sales of new-to-brand purchases for promoted products in local currency.');
        expect(ProductReportMetric::BRAND_HALO_NEW_TO_BRAND_PURCHASES_14D->description())->toEqual('Ad click-attributed new-to-brand purchases for brand halo products.');
        expect(ProductReportMetric::BRAND_HALO_NEW_TO_BRAND_UNITS_SOLD_14D->description())->toEqual('Ad click-attributed units sold in new-to-brand purchases for brand halo products.');
        expect(ProductReportMetric::BRAND_HALO_NEW_TO_BRAND_SALES_14D->description())->toEqual('Ad click-attributed sales of new-to-brand purchases for brand halo products in local currency.');
    }
);

test(
    'ProductReportMetric all method',
    function () {
        expect(ProductReportMetric::all())->toMatchArray(ProductReportMetric::cases());
    }
);

test(
    'ProductReportMetric value method',
    function () {
        foreach (ProductReportMetric::cases() as $productReportMetric) {
            expect($productReportMetric->value())->toEqual($productReportMetric->value);
        }
    }
);
