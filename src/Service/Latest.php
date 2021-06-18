<?php

namespace PlanetaDelEste\BCUCurrency\Service;

use PlanetaDelEste\BCUCurrency\Client;

/**
 * @method LatestResponse exec()
 */
class Latest extends Client
{
    /**
     * @return \PlanetaDelEste\BCUCurrency\Service\LatestResponse
     * @throws \Exception
     */
    public function get(): LatestResponse
    {
        return $this->exec();
    }

    /**
     * @inheritDoc
     */
    public function getService(): string
    {
        return self::SERVICES[3];
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return LatestResponse::class;
    }
}
