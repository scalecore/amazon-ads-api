<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use ScaleCore\AmazonAds\Helpers\Cast;
use Square\Pjson\JsonSerialize;

class DateTime extends \DateTime
{
    use JsonSerialize;

    protected string $format = 'Ymd';

    /**
     * @param string|int                      $jd
     * @param array<array-key, string>|string $path
     *
     * @throws \Exception
     */
    public static function fromJsonData($jd, array|string $path = []): self
    {
        if (is_int($jd)) {
            return (new self())->setTimestamp($jd);
        }

        return new self(Cast::toString($jd));
    }

    public function toJsonData(): string
    {
        return $this->format($this->format);
    }
}
