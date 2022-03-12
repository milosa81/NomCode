<?php

namespace NDC\BlogBundle\Twig;

use Symfony\Component\Translation\TranslatorInterface;


class ArticlePreviewExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('stripHTML', array($this, 'stripHtml'), array('is_safe' => array('html'))),
        );
    }

    public function stripHtml($txt, $length = 0)
    {
        $txt = strip_tags(trim($txt));

        if($length != 0 && strlen($txt) > $length && strpos($txt, ' ', $length) !== false)
            $txt = substr($txt, 0, strpos($txt, ' ', $length)).'...';

        return $txt;
    }

    public function getName()
    {
        return 'article_preview_extension';
    }
}