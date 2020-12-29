<?php
/**
 * @package Sebcodes
 * @category Sebcodes Project
 * @author Sebastian Kiefer (sebcodes)
 * @version 1.0
 * @copyright 2020 Sebastian Kiefer
 * @since 2020
 * @link https://sebcodes.de
 **/
namespace Sebcodes;

use Exception;
use stdClass;

class WeatherApi
{

    private string $apikey;
    private string $countyTown;
    private object $weather;

    public function __construct($countyTown)
    {
        if (empty($countyTown)) throw new Exception("Town required");
        $this->countyTown = $countyTown;
        $this->apikey = "d96e57207afe189a59a4f77059849938";
    }
    public function get()
    {
        $weather = new stdClass;
        try {
            $jsonfile = @file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$this->countyTown."&units=metric&appid=".$this->apikey."");

            $this->jsondata = json_decode($jsonfile);
            if(!empty($this->jsondata)){
                $weather->temp = $this->jsondata->main->temp;
                $weather->pressure = $this->jsondata->main->pressure;
                $weather->mintemp = $this->jsondata->main->temp_min;
                $weather->maxtemp = $this->jsondata->main->temp_max;
                $weather->wind = $this->jsondata->wind->speed;
                $weather->humidity = $this->jsondata->main->humidity;
                $weather->desc = $this->jsondata->weather[0]->description;
                $weather->maind = $this->jsondata->weather[0]->main;
                $weather->countyTown = $this->countyTown;
                return $weather;
            }
            #set temperature to zero
            else{
                $weather->temp = 0;
                return $weather;
            }
        }
        catch (Exception $ex) {
            $weather->temp = 0;
            return $weather;
        }
    }
}