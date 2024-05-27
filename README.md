# BCU Currency

Currency API from Uruguayan BCU bank

[![](https://tokei.rs/b1/github/planetadeleste/bcu-currency)](https://github.com/XAMPPRocky/tokei_rs)

> Inspired in [biller/bcu](https://github.com/biller/bcu) package

## Installation

```bash
composer require planetadeleste/bcu-currency
```

## Usage

The main class `PlanetaDelEste\BCUCurrency\Currency` has three static methods, `currencies(), latest(), rate()`. Each
one call a different Soap service, based on url `https://cotizaciones.bcu.gub.uy/wscotizaciones/servlet/`

### Get currencies

Get a list of local or global currencies

```php
$obCurrencies = \PlanetaDelEste\BCUCurrency\Currency::currencies();
$obResponse = $obCurrencies->local();

$arItems = $obResponse->getItems();
```

#### Methods

| Name       | Params          | Return               | Description                                                    |
| ---------- | --------------- | -------------------- | -------------------------------------------------------------- |
| `get`      | `$iGroupID` int | `CurrenciesResponse` | Results currencies from both markets (local and international) |
| `both`     |                 | `CurrenciesResponse` | Results currencies from both markets (local and international) |
| `global`   |                 | `CurrenciesResponse` | Results currencies from international markets only             |
| `local`    |                 | `CurrenciesResponse` | Results currencies from local markets only                     |
| `getItems` |                 | `array`              | Return an array of items like example bellow                   |

#### Response

Class `\PlanetaDelEste\BCUCurrency\Service\CurrenciesResponse`

##### Methods

| Name       | Params | Return  | Description                                   |
| ---------- | ------ | ------- | --------------------------------------------- |
| `getItems` |        | `array` | Return an array of `ItemRef` like example bellow |

###### Properties

>  \PlanetaDelEste\BCUCurrency\Service\Currencies\ItemRef

| Property | Value    | Description          |
| -------- | -------- | -------------------- |
| `Codigo` | `int`    | Numeric currecy code |
| `Nombre` | `string` | Name of currency     |

```json
[
  {
    "Codigo": 501,
    "Nombre": "PESO ARG.BILLETE"
  },
  {
    "Codigo": 1001,
    "Nombre": "REAL BILLETE"
  },
  {
    "Codigo": 2224,
    "Nombre": "DLS. USA CABLE"
  },
  {
    "Codigo": 2225,
    "Nombre": "DLS. USA BILLETE"
  },
  {
    "Codigo": 2230,
    "Nombre": "DLS.PROMED.FONDO"
  },
  {
    "Codigo": 9700,
    "Nombre": "UNIDAD PREVISIONAL"
  },
  {
    "Codigo": 9800,
    "Nombre": "UNIDAD INDEXADA"
  },
  {
    "Codigo": 9900,
    "Nombre": "UNIDAD REAJUSTAB"
  }
]
```

### Get last closed

Returns the date of last rate closed

#### Methods

| Name  | Params | Return                                               | Description |
| ----- | ------ | ---------------------------------------------------- | ----------- |
| `get` |        | `\PlanetaDelEste\BCUCurrency\Service\LatestResponse` |             |



#### Usage

```php
$obLatest = \PlanetaDelEste\BCUCurrency\Currency::latest();
$obResponse = $obLatest->get();

$sDate = $obResponse->getFecha();
print_r($sDate);
```

#### Response

| Name       | Params | Return   | Description                |
| ---------- | ------ | -------- | -------------------------- |
| `getFecha` |        | `string` | Get date in `Y-m-d` format |

`2021-06-17`

### Get rate

Get rate data of selected currency and dates

> **NAMESPACE** `\PlanetaDelEste\BCUCurrency\Service`
>
> **CLASS** `Rate`

```php
$obLatest = \PlanetaDelEste\BCUCurrency\Currency::latest()->get();
$obRate = \PlanetaDelEste\BCUCurrency\Currency::rate();
$obLocalResponse = $obRate->local()->from($obLatest->getFecha())->usd()->get();
$obGlobalResponse = $obRate->global()->from($obLatest->getFecha())->usd()->get();


print_r($obLocalResponse->getItems());
print_r($obGlobalResponse->getItems());
```

#### Methods

| Name     | Params         | Return | Description                                              |
| -------- | -------------- | ------ | -------------------------------------------------------- |
| `local`  |                | `Rate` | Get local currencies                                     |
| `global` |                | `Rate` | Get international currencies                             |
| `both`   |                | `Rate` | Get both currencies                                      |
| `from`   | `string`       | `Rate` | Set date from in `Y-m-d` format                          |
| `to`     | `string`       | `Rate` | Set date to in `Y-m-d` format                            |
| `ars`    | `bool`         | `Rate` | Set/add Argentine peso currency                          |
| `brl`    | `bool`         | `Rate` | Set/add Brazilian real currency                          |
| `usd`    | `bool`         | `Rate` | Set/add USA Dollar currency                              |
| `eur`    | `bool`         | `Rate` | Set/add EUR currency. Only works with global currencies. |
| `get`    | `RateResponse` |        |                                                          |

#### Response

Return an array of `\PlanetaDelEste\BCUCurrency\Service\RateResponse\ItemRef` items

| Property        | Value    | Description                  |
| --------------- | -------- | ---------------------------- |
| `Fecha`         | `string` | Date of current rate (Y-m-d) |
| `Moneda`        | `int`    | Currency ID                  |
| `Nombre`        | `string` | Name of currency             |
| `CodigoISO`     | `string` | ISO code                     |
| `Emisor`        | `string` | Emmiter country              |
| `TCC`           | `float`  | Low value                    |
| `TCV`           | `float`  | High value                   |
| `ArbAct`        | `float`  | Arbitrage value              |
| `FormaArbitrar` | `int`    | Arbitrage format             |
