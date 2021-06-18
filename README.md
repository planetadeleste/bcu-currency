# BCU Currency

Currency API from Uruguayan BCU bank

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

| Name       | Params | Return  | Description                                  |
| ---------- | ------ | ------- | -------------------------------------------- |
| `getItems` |        | `array` | Return an array of items like example bellow |

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

```php
$obLatest = \PlanetaDelEste\BCUCurrency\Currency::latest();
$obResponse = $obLatest->get();

$sDate = $obResponse->getFecha();
```

`getFecha()` returns a string with date of last closed rate

#### Response

`2021-06-17`

### Get rate

Get rate data of selected currency and dates
