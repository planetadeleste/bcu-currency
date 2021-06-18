<?php

namespace PlanetaDelEste\BCUCurrency;

use PlanetaDelEste\BCUCurrency\Service\Currencies;
use PlanetaDelEste\BCUCurrency\Service\Latest;
use PlanetaDelEste\BCUCurrency\Service\Rate;

/**
 * @method static Currencies currencies()
 * @method static Latest     latest()
 * @method static Rate       rate()
 */
class Currency
{
    private static $services = [
        'currencies' => Currencies::class,
        'latest'     => Latest::class,
        'rate'       => Rate::class
    ];

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     * @throws \Exception
     */
    public static function __callStatic(string $name, array $arguments = [])
    {
        if (!array_key_exists($name, self::$services)) {
            throw new \Exception("Unknown service {$name}");
        }

        return new self::$services[$name]($arguments);
    }
}
