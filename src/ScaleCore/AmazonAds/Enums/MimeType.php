<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums;

enum MimeType: string
{
    case JSON         = 'application/json';
    case TEXT_PLAIN   = 'text/plain';
    case OCTET_STREAM = 'application/octet-stream';

    public function isJson(): bool
    {
        return $this === self::JSON;
    }
}
