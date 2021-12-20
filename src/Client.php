<?php

namespace PlanetaDelEste\BCUCurrency;

use SoapClient;

abstract class Client
{
    /** @var string Main soap url */
    const URL = 'https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/';

    /** @var string[] Wsdl available services */
    const SERVICES = ['awsbcumonedas', 'awsbcucotizaciones', 'awsultimocierre'];

    /** @var int Use moth markets (international and local) to get currency rates */
    const GROUP_BOTH = 0;

    /** @var int Use an international market to get currency rates */
    const GROUP_GLOBAL = 1;

    /** @var int Use a local market to get currency rates */
    const GROUP_LOCAL = 2;

    /** @var int US Dollar code */
    const CODE_USD = 2225;

    /** @var int Brazil Real code */
    const CODE_BRL = 1001;

    /** @var int Argentine Peso code */
    const CODE_ARG = 501;

    /** @var int Global US Dollar code */
    const CODE_GLOBAL_USD = 2222;

    /** @var int Global Euro code */
    const CODE_GLOBAL_EUR = 1111;

    /** @var int Global Brazil Real code */
    const CODE_GLOBAL_BRL = 100;

    /** @var int Global Argentine Peso code */
    const CODE_GLOBAL_ARG = 500;

    /** @var int Uruguayan Indexed Unit */
    const CODE_UI = 9800;

    /** @var SoapClient */
    protected $client;

    public function getLastRequest(): ?string
    {
        return $this->client instanceof SoapClient ? $this->client->__getLastRequest() : null;
    }

    /**
     * @param array $arParams
     *
     * @return mixed
     * @throws \Exception
     */
    public function exec(array $arParams = [])
    {
        $obResponse = $this->soap(['trace' => true])->Execute($arParams);
        $sResponseClass = $this->getResponseClass();

        return new $sResponseClass($obResponse);
    }

    /**
     * @return SoapClient
     * @throws \Exception
     */
    protected function soap(array $arOptions = [])
    {
        $sService = $this->getService();

        if (!$sService || !in_array($sService, self::SERVICES)) {
            throw new \Exception('Service unknown');
        }

        $sSoapClass = $this->getSoapClass();
        $this->client = new $sSoapClass(self::URL.$sService.'?wsdl', $arOptions);

        return $this->client;
    }

    /**
     * @param int $iGroupID
     *
     * @return bool
     * @throws \Exception
     */
    protected function validateGroup(int $iGroupID): bool
    {
        if (!$iGroupID < 0 || $iGroupID > 2) {
            throw new \Exception("Unknown group {$iGroupID}. Valid groups are 0, 1, 2");
        }

        return true;
    }

    /**
     * @return string Name of service
     */
    abstract public function getService(): string;

    /**
     * @return string Use custom SoapClient class
     */
    public function getSoapClass(): string
    {
        return SoapClient::class;
    }

    /**
     * @return string
     */
    abstract public function getResponseClass(): string;

}
