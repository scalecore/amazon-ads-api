<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Models;

use ScaleCore\AmazonAds\Helpers\Cast;
use Square\Pjson\JsonDataSerializable;

abstract class BaseDateTime extends \DateTime implements JsonDataSerializable
{
    final public function __construct(string $dateTime = 'now', ?\DateTimeZone $timezone = null)
    {
        parent::__construct($dateTime, $timezone);
    }

    /**
     * @param string|int                      $jd
     * @param array<array-key, string>|string $path
     *
     * @throws \Exception
     */
    final public static function fromJsonData($jd, array|string $path = []): static
    {
        if (is_int($jd)) {
            return (new static())->setTimestamp($jd);
        }

        return new static(Cast::toString($jd));
    }

    final public function toJsonData(): string|int
    {
        $formattingString = $this->getFormattingString();

        return $formattingString === 'U'
            ? Cast::toInt($this->format($formattingString))
            : $this->format($formattingString);
    }

    /**
     * The format the DateTime instance is converted to when serializing to JSON.
     *
     * Return any combination of the allowed formatting characters or \DateTimeInterface constants
     * defined at https://www.php.net/manual/en/datetime.format.php.
     *
     * To convert to an integer timestamp return a value of `U`.
     * All other formatting returns string values.
     */
    abstract protected function getFormattingString(): string;
}
