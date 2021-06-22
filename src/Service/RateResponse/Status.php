<?php

namespace PlanetaDelEste\BCUCurrency\Service\RateResponse;

use PlanetaDelEste\BCUCurrency\Response;

/**
 * @property int    $status
 * @property int    $codigoerror
 * @property string $mensaje
 */
class Status extends Response
{

    public function getOutputKey(): ?string
    {
        return null;
    }
}
