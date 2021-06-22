<?php

namespace PlanetaDelEste\BCUCurrency\Service\RateResponse;

use PlanetaDelEste\BCUCurrency\Response;

/**
 * @property string $Fecha
 * @property int    $Moneda
 * @property string $Nombre
 * @property string $CodigoISO
 * @property string $Emisor
 * @property float  $TCC
 * @property float  $TCV
 * @property float  $ArbAct
 * @property int    $FormaArbitrar
 */
class Item extends Response
{

    public function getOutputKey(): ?string
    {
        return null;
    }
}
