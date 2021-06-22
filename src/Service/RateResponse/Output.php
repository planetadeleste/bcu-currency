<?php

namespace PlanetaDelEste\BCUCurrency\Service\RateResponse;

use PlanetaDelEste\BCUCurrency\Response;

/**
 * @property Status $respuestastatus
 * @property Item[] $datoscotizaciones
 */
class Output extends Response
{
    public function getStatus(): Status
    {
        return new Status($this->respuestastatus);
    }

    /**
     * @return \PlanetaDelEste\BCUCurrency\Service\RateResponse\Item|\PlanetaDelEste\BCUCurrency\Service\RateResponse\Item[]
     */
    public function getItems()
    {
        $obItems = $this->datoscotizaciones;
        if (!$obItems) {
            return null;
        }

        if (is_object($obItems) && property_exists($obItems, 'datoscotizaciones.dato')) {
            $obItems = $obItems->{'datoscotizaciones.dato'};
        }

        if (is_array($obItems)) {
            return array_map(function ($obItem) {
                return new Item($obItem);
            }, $obItems);
        }

        return new Item($obItems);
    }

    public function getOutputKey(): ?string
    {
        return null;
    }
}
