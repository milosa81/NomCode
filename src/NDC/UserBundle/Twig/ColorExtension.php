<?php


namespace NDC\UserBundle\Twig;


class ColorExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('opacity', array($this, 'opacityFilter')),
            new \Twig_SimpleFilter('lightness', array($this, 'lightnessFilter')),
        );
    }

    public function opacityFilter($hexa, $opacity)
    {
        $red = hexdec(substr($hexa, 0, 2));
        $green = hexdec(substr($hexa, 2, 2));
        $blue = hexdec(substr($hexa, 4, 2));

        return "rgba($red, $green, $blue, $opacity)";
    }

    public function lightnessFilter($hexa)
    {
        $red = hexdec(substr($hexa, 0, 2));
        $green = hexdec(substr($hexa, 2, 2));
        $blue = hexdec(substr($hexa, 4, 2));

        return ($red * 11 + $green * 16 + $blue * 5)/32 *100 /255;
    }

    public function getName()
    {
        return 'color_extension';
    }
} 