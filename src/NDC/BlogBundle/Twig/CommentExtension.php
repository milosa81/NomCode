<?php


namespace NDC\BlogBundle\Twig;

use Symfony\Component\Translation\TranslatorInterface;


class CommentExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('commentify', array($this, 'commentifyFilter'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
        );
    }

    public function commentifyFilter($txt)
    {
        $txt = '<p>' . trim($txt) . '</p>';
        $txt = str_replace("\r", '', $txt);
        $txt = preg_replace("/\n{2,}/", "</p><p>", $txt);
        $txt = preg_replace("/\n/", "<br>", $txt);
        $txt = preg_replace('/https?:\/\/[a-zA-Z0-9\.\-\/\?\=\#\&\~\|\_\@\+\,\$\%\:\;]+/', '<a href="$0" target="_blank">$0</a>', $txt);
        return $txt;
    }

    public function getName()
    {
        return 'comment_extension';
    }
} 