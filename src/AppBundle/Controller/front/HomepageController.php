<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 15. 12. 2016
 * Time: 16:30
 */

namespace AppBundle\Controller\front;


use AppBundle\Service\WeatherApi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends Controller
{
    /**
     * @var TwigEngine
     */
    private $twig;
    /**
     * @var WeatherApi
     */
    private $weatherApi;

    public function __construct(TwigEngine $twig, WeatherApi $weatherApi)
    {
        $this->twig = $twig;
        $this->weatherApi = $weatherApi;
    }

    /**
     * @return Response
     */
    public function defaultAction()
    {
        $client = new Predis\Client([
            'scheme' => 'tcp',
            'host'   => '10.0.0.1',
            'port'   => 6379,
        ]);
        dump(date('d.m.Y H:i', 1510754400));
        $this->weatherApi->getWeather();
        return $this->twig->renderResponse('front/homepage/index.html.twig');
    }
}