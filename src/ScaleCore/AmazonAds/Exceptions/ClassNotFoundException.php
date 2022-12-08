<?php

declare(strict_types=1);

namespace ScaleCore\AmazonAds\Exceptions;

class ClassNotFoundException extends \Exception
{
    /** Name of the class that was unable to be found. */
    private string $className;

    public function __construct(string $message, string $className)
    {
        parent::__construct($message);

        $this->className = $className;
    }

    /** Returns the name of the class that was unable to be found. */
    public function getClassName(): string
    {
        return $this->className;
    }
}
