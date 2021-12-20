<?php


namespace NDC\UserBundle\Twig;


class ColorExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('opacity', array($this, 'opacityFilter')),
        );
    }

    public function opacityFilter($hexa, $opacity)
    {
        $red = hexdec(substr($hexa, 0, 2));
        $green = hexdec(substr($hexa, 2, 2));
        $blue = hexdec(substr($hexa, 4, 2));

        return "rgba($red, $green, $blue, $opacity)";
    }

    public function getName()
    {
        return 'color_extension';
    }
} 