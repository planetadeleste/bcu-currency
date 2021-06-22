<?php

namespace PlanetaDelEste\BCUCurrency\Service\Currencies;

use PlanetaDelEste\BCUCurrency\Response;

/**
 * @property int    $Codigo
 * @property string $Nombre
 */
class Item extends Response
{

    public function getOutputKey(): ?string
    {
        return null;
    }
}
