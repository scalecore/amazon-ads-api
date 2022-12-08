<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

// uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

/*expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});*/

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

use ScaleCore\AmazonAds\Configuration;
use ScaleCore\AmazonAds\Contracts\HttpRequestAuthInterface;
use ScaleCore\AmazonAds\LoggerConfiguration;

function getConfiguration(
    HttpRequestAuthInterface $httpRequestAuth,
    LoggerConfiguration $loggerConfiguration = new LoggerConfiguration()
): Configuration {
    return new Configuration($httpRequestAuth, $loggerConfiguration);
}

function getArrTestArrayAccessObject(array $items): ArrayAccess
{
    return new class($items) implements ArrayAccess {
        private array $items;

        public function __construct(array $items)
        {
            $this->items = $items;
        }

        /**
         * {@inheritDoc}
         */
        public function offsetExists($offset): bool
        {
            return array_key_exists($offset, $this->items);
        }

        /**
         * {@inheritDoc}
         */
        public function offsetGet($offset): mixed
        {
            return $this->items[$offset] ?? null;
        }

        /**
         * {@inheritDoc}
         */
        public function offsetSet($offset, $value): void
        {
            $this->items[$offset] = $value;
        }

        /**
         * {@inheritDoc}
         */
        public function offsetUnset($offset): void
        {
            unset($this->items[$offset]);
        }
    };
}
