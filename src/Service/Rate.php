<?php

namespace PlanetaDelEste\BCUCurrency\Service;

use PlanetaDelEste\BCUCurrency\Client;

/**
 * @method RateResponse exec(array $arOptions = [])
 */
class Rate extends Client
{
    /** @var int Group code (local by default) */
    protected $iGroupID = self::GROUP_LOCAL;

    /** @var int[] Currency codes (USD by default) */
    protected $arCurrencyCode = [];

    /** @var string Date from (YYYY-MM-DD format) */
    protected $from;

    /** @var string Date to (YYYY-MM-DD format) */
    protected $to;

    /**
     * @return RateResponse
     * @throws \Exception
     */
    public function get(): RateResponse
    {
        $this->validateGroup($this->iGroupID);

        if (empty($this->arCurrencyCode)) {
            $this->usd();
        }

        if (!$this->from) {
            $this->from = date('Y-m-d');
        }

        if (!$this->to) {
            $this->to = $this->from;
        }

        $arParams = [
            'Entrada' => [
                'Grupo'      => $this->iGroupID,
                'FechaDesde' => $this->from,
                'FechaHasta' => $this->to,
                'Moneda'     => $this->mapCurrencies()
            ]
        ];

        return $this->exec($arParams);
    }

    /**
     * Set/Add USA Dollar currency code
     *
     * @param bool $bAdd
     *
     * @return $this
     */
    public function usd(bool $bAdd = false): self
    {
        $iCode = $this->isGlobal() || $this->isBoth() ? self::CODE_GLOBAL_USD : self::CODE_USD;

        if ($bAdd) {
            $this->addCurrencyCode($iCode);
        } else {
            $this->setCurrencyCode($iCode);
        }

        return $this;
    }

    /**
     * Add a currency code to request
     *
     * @param int $iCode
     *
     * @return $this
     */
    public function addCurrencyCode(int $iCode): self
    {
        $this->arCurrencyCode[] = $iCode;

        return $this;
    }

    /**
     * Set currency code for request
     *
     * @param int $iCode
     *
     * @return $this
     */
    public function setCurrencyCode(int $iCode): self
    {
        $this->arCurrencyCode = [$iCode];

        return $this;
    }

    protected function mapCurrencies(): array
    {
        if (!is_array($this->arCurrencyCode)) {
            $this->arCurrencyCode = [$this->arCurrencyCode];
        }

        if (count($this->arCurrencyCode) === 1) {
            return ['item' => $this->arCurrencyCode[0]];
        }
        return ['item' => $this->arCurrencyCode];
    }

    /**
     * Add USA Dollar currency code
     *
     * @return $this
     */
    public function addUsd(): self
    {
        return $this->usd(true);
    }

    /**
     * Get currencies from a local market
     *
     * @return $this
     */
    public function local(): self
    {
        $this->iGroupID = self::GROUP_LOCAL;

        return $this;
    }

    /**
     * Get currencies from a international market
     *
     * @return $this
     */
    public function global(): self
    {
        $this->iGroupID = self::GROUP_GLOBAL;

        return $this;
    }

    /**
     * Get currencies from both markets (local and international)
     *
     * @return $this
     */
    public function both(): self
    {
        $this->iGroupID = self::GROUP_BOTH;

        return $this;
    }

    /**
     * Set starst date for request
     *
     * @param string $sValue
     *
     * @return $this
     */
    public function from(string $sValue): self
    {
        $this->from = $sValue;

        return $this;
    }

    /**
     * Set end date for request
     *
     * @param string $sValue
     *
     * @return $this
     */
    public function to(string $sValue): self
    {
        $this->to = $sValue;

        return $this;
    }

    /**
     * Add Uruguayan indexed unit code
     *
     * @return $this
     */
    public function addUi(): self
    {
        return $this->ui(true);
    }

    /**
     * Set/Add Uruguayan indexed unit code
     *
     * @param bool $bAdd
     *
     * @return $this
     */
    public function ui(bool $bAdd = false): self
    {
        if ($this->isGlobal()) {
            return $this;
        }

        $iCode = self::CODE_UI;

        if ($bAdd) {
            $this->addCurrencyCode($iCode);
        } else {
            $this->setCurrencyCode($iCode);
        }

        return $this;
    }

    /**
     * Add Argentine peso code
     *
     * @return $this
     */
    public function addArs(): self
    {
        return $this->ars(true);
    }

    /**
     * Set/Add Argentine peso code
     *
     * @param bool $bAdd
     *
     * @return $this
     */
    public function ars(bool $bAdd = false): self
    {
        $iCode = $this->isGlobal() || $this->isBoth() ? self::CODE_GLOBAL_ARG : self::CODE_ARG;

        if ($bAdd) {
            $this->addCurrencyCode($iCode);
        } else {
            $this->setCurrencyCode($iCode);
        }

        return $this;
    }

    /**
     * Add Brazil real code
     *
     * @return $this
     */
    public function addBrl(): self
    {
        return $this->brl(true);
    }

    /**
     * Set/Add Brazil real code
     *
     * @param bool $bAdd
     *
     * @return $this
     */
    public function brl(bool $bAdd = false): self
    {
        $iCode = $this->isGlobal() || $this->isBoth() ? self::CODE_GLOBAL_BRL : self::CODE_BRL;

        if ($bAdd) {
            $this->addCurrencyCode($iCode);
        } else {
            $this->setCurrencyCode($iCode);
        }

        return $this;
    }

    /**
     * Set/Add Euro only for global rates
     *
     * @param bool $bAdd
     *
     * @return $this
     */
    public function eur(bool $bAdd = false): self
    {
        if ($this->isLocal()) {
            return $this;
        }

        $iCode = self::CODE_GLOBAL_EUR;

        if ($bAdd) {
            $this->addCurrencyCode($iCode);
        } else {
            $this->setCurrencyCode($iCode);
        }

        return $this;
    }

    public function addEur(): self
    {
        return $this->eur(true);
    }

    /**
     * Returns true if current group is local
     *
     * @return bool
     */
    public function isLocal(): bool
    {
        return $this->iGroupID == self::GROUP_LOCAL;
    }

    /**
     * Returns true if current group is gloabl
     *
     * @return bool
     */
    public function isGlobal(): bool
    {
        return $this->iGroupID == self::GROUP_GLOBAL;
    }

    /**
     * Returns true if current group is local and gloabl
     *
     * @return bool
     */
    public function isBoth(): bool
    {
        return $this->iGroupID == self::GROUP_BOTH;
    }

    /**
     * @inheritDoc
     */
    public function getResponseClass(): string
    {
        return RateResponse::class;
    }

    /**
     * @inheritDoc
     */
    public function getService(): string
    {
        return self::SERVICES[1];
    }
}
