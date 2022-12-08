<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Enums\CountryCode;
use ScaleCore\AmazonAds\Enums\Region;

test(
    'Region description method',
    function () {
        expect(Region::NORTH_AMERICA->description())->toEqual('North America (NA). Covers US, CA, MX, and BR marketplaces');
        expect(Region::EUROPEAN_UNION->description())->toEqual('Europe (EU). Covers UK, FR, IT, ES, DE, NL, AE, PL, TR, and EG marketplaces');
        expect(Region::FAR_EAST->description())->toEqual('Far East (FE). Covers JP, AU, and SG marketplaces');
    }
);

test(
    'Region host method',
    function () {
        expect(Region::NORTH_AMERICA->host())->toEqual('advertising-api.amazon.com');
        expect(Region::EUROPEAN_UNION->host())->toEqual('advertising-api-eu.amazon.com');
        expect(Region::FAR_EAST->host())->toEqual('advertising-api-fe.amazon.com');
    }
);

test(
    'Region url method',
    function () {
        expect(Region::NORTH_AMERICA->url())->toEqual('https://advertising-api.amazon.com');
        expect(Region::EUROPEAN_UNION->url())->toEqual('https://advertising-api-eu.amazon.com');
        expect(Region::FAR_EAST->url())->toEqual('https://advertising-api-fe.amazon.com');
    }
);

test(
    'Region fromCountryCode method throws \ValueError for invalid country code string',
    function () {
        Region::fromCountryCode('zz');
    }
)->throws(\ValueError::class);

test(
    'Region fromCountryCode method with country code string',
    function () {
        expect(Region::fromCountryCode('US'))->toEqual(Region::NORTH_AMERICA);
        expect(Region::fromCountryCode('GB'))->toEqual(Region::EUROPEAN_UNION);
        expect(Region::fromCountryCode('AU'))->toEqual(Region::FAR_EAST);
    }
);

test(
    'Region fromCountryCode method with CountryCode object',
    function () {
        expect(Region::fromCountryCode(CountryCode::US))->toEqual(Region::NORTH_AMERICA);
        expect(Region::fromCountryCode(CountryCode::GB))->toEqual(Region::EUROPEAN_UNION);
        expect(Region::fromCountryCode(CountryCode::AU))->toEqual(Region::FAR_EAST);
    }
);
