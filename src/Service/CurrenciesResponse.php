<?php

namespace PlanetaDelEste\BCUCurrency\Service;

use PlanetaDelEste\BCUCurrency\Response;

class CurrenciesResponse extends Response
{
    /**
     * @return \PlanetaDelEste\BCUCurrency\Service\Currencies\Item[]
     */
    public function getItems(): array
    {
        return $this->getSalida() ? $this->getSalida()->{'wsmonedasout.Linea'} : [];
    }
}
