<?php
/**
 * Created by PhpStorm.
 * User: cleevio
 * Date: 22/11/2017
 * Time: 14:12
 */

namespace AppBundle\Extensions;


class TemperatureTwigExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('celsius', array($this, 'celsiusFilter')),
        );
    }

    public function celsiusFilter($number, $decimals = 1, $decPoint = '.', $thousandsSep = ' ')
    {
        $temp = number_format($number, $decimals, $decPoint, $thousandsSep);
        $temp = $temp. ' °C';

        return $temp;
    }

    public function getName()
    {
        return 'app.twig.temperature';
    }
}