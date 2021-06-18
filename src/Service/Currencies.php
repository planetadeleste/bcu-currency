<?php

namespace PlanetaDelEste\BCUCurrency\Service;

use PlanetaDelEste\BCUCurrency\Client;

/**
 * @method CurrenciesResponse exec(array $arOptions = [])
 */
class Currencies extends Client
{
    /**
     * Get currencies from both markets (local and international)
     *
     * @return CurrenciesResponse
     * @throws \Exception
     */
    public function both(): CurrenciesResponse
    {
        return $this->get(self::GROUP_BOTH);
    }

    /**
     * @param int $iGroupID
     *
     * @return CurrenciesResponse
     * @throws \Exception
     */
    public function get(int $iGroupID = self::GROUP_BOTH): CurrenciesResponse
    {
        $this->validateGroup($iGroupID);
        $arParams = ['Entrada' => ['Grupo' => $iGroupID]];

        return $this->exec($arParams);
    }

    /**
     * Get currencies from a international market
     *
     * @return CurrenciesResponse
     * @throws \Exception
     */
    public function global(): CurrenciesResponse
    {
        return $this->get(self::GROUP_GLOBAL);
    }

    /**
     * Get currencies from a local market
     *
     * @return CurrenciesResponse
     * @throws \Exception
     */
    public function local(): CurrenciesResponse
    {
        return $this->get(self::GROUP_LOCAL);
    }

    /**
     * @inheritDoc
     */
    public function getService(): string
    {
        return self::SERVICES[0];
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return CurrenciesResponse::class;
    }
}
