<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Enums\Attribution\PerformanceReportMetric;

test(
    'PerformanceReportMetric description method',
    function () {
        expect(PerformanceReportMetric::CLICK_THROUGHS->description())->toEqual('Ad clicks.');
        expect(PerformanceReportMetric::ATTRIBUTED_DETAIL_PAGE_VIEWS_CLICKS_14D->description())->toEqual('Ad click-attributed detail page views for promoted product.');
        expect(PerformanceReportMetric::ATTRIBUTED_ADD_TO_CART_CLICKS_14D->description())->toEqual('Ad click-attributed add to carts for promoted products.');
        expect(PerformanceReportMetric::ATTRIBUTED_PURCHASES_14D->description())->toEqual('Ad click-attributed purchases for promoted products.');
        expect(PerformanceReportMetric::UNITS_SOLD_14D->description())->toEqual('Ad click-attributed units sold for promoted products.');
        expect(PerformanceReportMetric::ATTRIBUTED_SALES_14D->description())->toEqual('Ad click-attributed sales for promoted products in local currency.');
        expect(PerformanceReportMetric::ATTRIBUTED_TOTAL_DETAIL_PAGE_VIEWS_CLICKS_14D->description())->toEqual('Ad click-attributed detail page views for promoted products plus brand halo products.');
        expect(PerformanceReportMetric::ATTRIBUTED_TOTAL_ADD_TO_CART_CLICKS_14D->description())->toEqual('Ad click-attributed add to carts for promoted products plus brand halo products.');
        expect(PerformanceReportMetric::ATTRIBUTED_TOTAL_PURCHASES_14D->description())->toEqual('Ad click-attributed purchases for promoted products plus brand halo products.');
        expect(PerformanceReportMetric::TOTAL_UNITS_SOLD14D->description())->toEqual('Ad click-attributed units sold for promoted products plus brand halo products.');
        expect(PerformanceReportMetric::TOTAL_ATTRIBUTED_SALES_14D->description())->toEqual('Ad click-attributed attributed sales for promoted products plus brand halo products.');
        expect(PerformanceReportMetric::BRB_BONUS_AMOUNT->description())->toEqual('Estimated ad-attributed Brand Referral Bonus credit amount in local currency.');
    }
);

test(
    'PerformanceReportMetric allForCreativeGroupBy method',
    function () {
        expect(PerformanceReportMetric::allForCreativeGroupBy())
            ->toMatchArray(
                [
                    PerformanceReportMetric::CLICK_THROUGHS,
                    PerformanceReportMetric::ATTRIBUTED_DETAIL_PAGE_VIEWS_CLICKS_14D,
                    PerformanceReportMetric::ATTRIBUTED_ADD_TO_CART_CLICKS_14D,
                    PerformanceReportMetric::ATTRIBUTED_PURCHASES_14D,
                    PerformanceReportMetric::UNITS_SOLD_14D,
                    PerformanceReportMetric::ATTRIBUTED_SALES_14D,
                    PerformanceReportMetric::ATTRIBUTED_TOTAL_DETAIL_PAGE_VIEWS_CLICKS_14D,
                    PerformanceReportMetric::ATTRIBUTED_TOTAL_ADD_TO_CART_CLICKS_14D,
                    PerformanceReportMetric::ATTRIBUTED_TOTAL_PURCHASES_14D,
                    PerformanceReportMetric::TOTAL_UNITS_SOLD14D,
                    PerformanceReportMetric::TOTAL_ATTRIBUTED_SALES_14D,
                ]
            );
    }
);

test(
    'PerformanceReportMetric all method',
    function () {
        expect(PerformanceReportMetric::all())->toMatchArray(PerformanceReportMetric::cases());
    }
);

test(
    'PerformanceReportMetric value method',
    function () {
        foreach (PerformanceReportMetric::cases() as $performanceReportMetric) {
            expect($performanceReportMetric->value())->toEqual($performanceReportMetric->value);
        }
    }
);
