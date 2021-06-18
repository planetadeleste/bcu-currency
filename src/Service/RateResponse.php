<?php

namespace PlanetaDelEste\BCUCurrency\Service;

use PlanetaDelEste\BCUCurrency\Response;
use PlanetaDelEste\BCUCurrency\Service\RateResponse\Output;
use PlanetaDelEste\BCUCurrency\Service\RateResponse\Status;
use PlanetaDelEste\BCUCurrency\Service\RateResponse\Item;

/**
 * @method Output getSalida()
 */
class RateResponse extends Response
{
    /**
     * @return null|Status
     */
    public function getStatus()
    {
        return $this->getSalida() ? $this->getSalida()->respuestastatus : null;
    }

    /**
     * @return array|Item[]
     */
    public function getItems()
    {
        return $this->getSalida() ? $this->getSalida()->datoscotizaciones : [];
    }
}
