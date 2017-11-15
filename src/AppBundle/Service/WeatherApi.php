<?php
/**
 * Created by PhpStorm.
 * User: cleevio
 * Date: 15/11/2017
 * Time: 14:50
 */

namespace AppBundle\Service;


class WeatherApi
{
    const API_URL = "http://api.openweathermap.org/data/2.5/weather";
    private $apiKey;
    private $cityId;

    /**
     * WeatherApi constructor.
     * @param $apiKey
     * @param $cityId
     */
    public function __construct($apiKey, $cityId)
    {
        $this->apiKey = $apiKey;
        $this->cityId = $cityId;
    }


    private function doRequest($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = json_decode(curl_exec($ch), true);

        return $response;
    }

    public function getWeather()
    {
        $response = $this->doRequest(self::API_URL . '?appid='. $this->apiKey. '&id='. $this->cityId. '&lang=sk&units=metric');

        dump($response);
    }
}