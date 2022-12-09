<?php

declare(strict_types=1);

use ScaleCore\AmazonAds\Support\UniqidGenerator;

test(
    'UniqidGenerator returns unique string',
    function () {
        $generator = new UniqidGenerator();

        expect($generator->generate())->toBeString()->toStartWith('correlation_id_');
    }
);
