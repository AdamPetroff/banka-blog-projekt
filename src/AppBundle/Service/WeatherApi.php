<?php
/**
 * Created by PhpStorm.
 * User: cleevio
 * Date: 15/11/2017
 * Time: 14:50
 */

namespace AppBundle\Service;


use Predis\Client;

class WeatherApi
{
    const API_URL = "http://api.openweathermap.org/data/2.5/weather";
    const ICON_URL = "http://openweathermap.org/img/w/{code}.png";
    private $apiKey;
    private $cityId;
    /**
     * @var Client
     */
    private $redis;

    /**
     * WeatherApi constructor.
     * @param $apiKey
     * @param $cityId
     */
    public function __construct(Client $redis, $apiKey, $cityId)
    {
        $this->apiKey = $apiKey;
        $this->cityId = $cityId;
        $this->redis = $redis;
    }


    private function doRequest($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = json_decode(curl_exec($ch), true);

        return $response;
    }

    public function getWeather()
    {
        if($this->redis->exists('weather')){
            return $this->redis->hgetall('weather');
        }
        $response = $this->doRequest(self::API_URL . '?appid='. $this->apiKey. '&id='. $this->cityId. '&lang=sk&units=metric');

        $weather = [
            'description' => $response['weather'][0]['description'],
            'icon_url' => $this->getIconUrl($response['weather'][0]['icon']),
            'temp' => round($response['main']['temp'],1)
        ];

        $this->redis->hmset('weather', $weather);
        $this->redis->expire('weather', 1800);

        return $weather;
    }

    private function getIconUrl($code)
    {
        return str_replace('{code}', $code, self::ICON_URL);
    }
}