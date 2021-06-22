<?php

namespace PlanetaDelEste\BCUCurrency\Service;

use PlanetaDelEste\BCUCurrency\Response;
use PlanetaDelEste\BCUCurrency\Service\RateResponse\Output;
use PlanetaDelEste\BCUCurrency\Service\RateResponse\Status;
use PlanetaDelEste\BCUCurrency\Service\RateResponse\Item;

class RateResponse extends Response
{
    /**
     * @return null|Status
     */
    public function getStatus(): ?Status
    {
        return (new Output($this->getOutput()))->getStatus();
    }

    /**
     * @return \PlanetaDelEste\BCUCurrency\Service\RateResponse\Item|\PlanetaDelEste\BCUCurrency\Service\RateResponse\Item[]
     */
    public function getItems()
    {
        return (new Output($this->getOutput()))->getItems();
    }

    public function getOutputKey(): ?string
    {
        return null;
    }
}
