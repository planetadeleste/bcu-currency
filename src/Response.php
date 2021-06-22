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
     * @return \stdClass|\stdClass[]|null
     * @deprecated Use getOutput()
     */
    public function getSalida()
    {
        return $this->getOutput();
    }

    /**
     * @return null|\stdClass|\stdClass[]
     */
    public function getOutput()
    {
        if (!$this->obResponse) {
            return null;
        }
        $sOutputKey = $this->getOutputKey();
        $obOutput = $this->obResponse->Salida;
        return $sOutputKey && is_object($obOutput) ? $obOutput->{$sOutputKey} : $obOutput;
    }

    abstract public function getOutputKey(): ?string;

    public function __get($name)
    {
        if (!$this->obResponse || !property_exists($this->obResponse, $name)) {
            return null;
        }

        return $this->obResponse->{$name};
    }
}
