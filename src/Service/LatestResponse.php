<?php

namespace PlanetaDelEste\BCUCurrency\Service;

use PlanetaDelEste\BCUCurrency\Response;

class LatestResponse extends Response
{
    /**
     * @return null|string
     */
    public function getFecha(): ?string
    {
        return $this->getSalida() ? $this->getSalida()->Fecha : null;
    }
}
