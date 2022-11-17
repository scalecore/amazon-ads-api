<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Enums;

enum PrimitiveType
{
    case INT;
    case FLOAT;
    case STRING;
    case BOOL;
    case ARRAY;
    case OBJECT;
}
