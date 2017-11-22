<?php
/**
 * Created by PhpStorm.
 * User: cleevio
 * Date: 21/11/2017
 * Time: 16:02
 */

namespace AppBundle\Extensions;

use AppBundle\Service\NameDay;
use AppBundle\Service\WeatherApi;

class GlobalsTwigExtension extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{
    /**
     * @var WeatherApi
     */
    private $weatherApi;
    /**
     * @var NameDay
     */
    private $nameDay;

    /**
     * GlobalsTwigExtension constructor.
     */
    public function __construct(WeatherApi $weatherApi, NameDay $nameDay)
    {
        $this->weatherApi = $weatherApi;
        $this->nameDay = $nameDay;
    }

    public function getGlobals()
    {
        return array(
            'weather' => $this->weatherApi->getWeather(),
            'nameDay' => $this->nameDay->getNameDay()
        );
    }

    // ...

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
       return 'app.twig.globals';
    }
}