<?php

namespace PlanetaDelEste\BCUCurrency\Service;

use PlanetaDelEste\BCUCurrency\Response;
use PlanetaDelEste\BCUCurrency\Service\Currencies\Item;

class CurrenciesResponse extends Response
{
    /**
     * @return \PlanetaDelEste\BCUCurrency\Service\Currencies\Item[]
     */
    public function getItems(): array
    {
        $arOuput = $this->getOutput();
        if (is_array($arOuput)) {
            return array_map(function($obOutput) {
                return new Item($obOutput);
            }, $arOuput);
        }
    }

    public function getOutputKey(): ?string
    {
        return 'wsmonedasout.Linea';
    }
}
