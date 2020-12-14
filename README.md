# WeatherAPI

A WeatherAPI class written in PHP that works with the openweathermap API

## Installation

Extract the downloaded zip in your directory

## Usage

```php
<?php

#include file
require_once 'WeatherAPI.php';

#set town/country

$weather = new \Sebcodes\WeatherAPI("Germany");

#get temperature
echo $weather->get()->temp;
    

```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.
