<?php

namespace PlanetaDelEste\BCUCurrency;

abstract class Response
{
    /** @var \stdClass */
    protected $obResponse;

    public function __construct($obResponse)
    {
        if (is_object($obResponse)) {
            $this->obResponse = $obResponse;
        }
    }

    /**
     * @return null|\stdClass
     */
    public function getSalida(): ?\stdClass
    {
        return $this->obResponse ? $this->obResponse->Salida : null;
    }
}
