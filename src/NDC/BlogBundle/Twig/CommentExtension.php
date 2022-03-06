<?php


namespace NDC\BlogBundle\Twig;

use Symfony\Component\Translation\TranslatorInterface;


class CommentExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('commentify', array($this, 'commentifyFilter', array('is_safe' => array('html')))),
        );
    }

    public function commentifyFilter($txt)
    {
        return $txt;
    }

    public function getName()
    {
        return 'comment_extension';
    }
} 