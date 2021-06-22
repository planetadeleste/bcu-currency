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
        return $this->getOutput() ? $this->getOutput()->Fecha : null;
    }

    public function getOutputKey(): ?string
    {
        return null;
    }
}
