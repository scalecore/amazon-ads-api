<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Enums\CountryCode;

test(
    'CountryCode description method',
    function () {
        expect(CountryCode::US->description())->toEqual('United States');
        expect(CountryCode::CA->description())->toEqual('Canada');
        expect(CountryCode::MX->description())->toEqual('Mexico');
        expect(CountryCode::BR->description())->toEqual('Brazil');
        expect(CountryCode::UK->description())->toEqual('United Kingdom');
        expect(CountryCode::GB->description())->toEqual('United Kingdom (Great Britain)');
        expect(CountryCode::EG->description())->toEqual('Egypt');
        expect(CountryCode::DE->description())->toEqual('Germany');
        expect(CountryCode::FR->description())->toEqual('France');
        expect(CountryCode::ES->description())->toEqual('Spain');
        expect(CountryCode::IT->description())->toEqual('Italy');
        expect(CountryCode::NL->description())->toEqual('The Netherlands');
        expect(CountryCode::AE->description())->toEqual('United Arab Emirates');
        expect(CountryCode::SE->description())->toEqual('Sweden');
        expect(CountryCode::PL->description())->toEqual('Poland');
        expect(CountryCode::TR->description())->toEqual('Turkey');
        expect(CountryCode::JP->description())->toEqual('Japan');
        expect(CountryCode::AU->description())->toEqual('Australia');
        expect(CountryCode::SG->description())->toEqual('Singapore');
    }
);
