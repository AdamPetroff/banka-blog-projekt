<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 15. 12. 2016
 * Time: 16:30
 */

namespace AppBundle\Controller\front;


use AppBundle\Service\ArticleManager;
use AppBundle\Service\NameDay;
use AppBundle\Service\WeatherApi;
use Predis\Client;
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
    /**
     * @var NameDay
     */
    private $nameDay;
    /**
     * @var ArticleManager
     */
    private $articleManager;

    public function __construct(TwigEngine $twig, WeatherApi $weatherApi, NameDay $nameDay, ArticleManager $articleManager)
    {
        $this->twig = $twig;
        $this->weatherApi = $weatherApi;
        $this->nameDay = $nameDay;
        $this->articleManager = $articleManager;
    }

    /**
     * @return Response
     */
    public function defaultAction()
    {
        return $this->twig->renderResponse('front/homepage/index.html.twig', [
            'weather' => $this->weatherApi->getWeather(),
            'nameday' => $this->nameDay->getNameDay(),
//            'articles' => $this->articleManager->getPresentable()
            'articles' => []
        ]);
    }
}