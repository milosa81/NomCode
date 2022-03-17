<?php


namespace NDC\BlogBundle\Twig;

use Symfony\Component\Translation\TranslatorInterface;

class DateExtension extends \Twig_Extension
{
    /** @var TranslatorInterface */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('fullDate', array($this, 'fullDateFilter')),
        );
    }

    public function fullDateFilter(\DateTime $date = null, $showDay = true)
    {
        if($date == null)
            return '';

        $now = new \DateTime();

        if($now->format('d-m-Y') == $date->format('d-m-Y'))
            return "aujourd'hui";
        if((new \DateTime("-1day"))->format('d-m-Y') == $date->format('d-m-Y'))
            return "hier";
        if((new \DateTime("+1day"))->format('d-m-Y') == $date->format('d-m-Y'))
            return "demain";

        $elements = array();;

        if($showDay)
            $elements[] = $this->trans('day.'.$date->format('N'));

        $elements[] = $date->format('j');
        $elements[] = $this->trans('month.'.$date->format('n'));

        if($date->format('Y') != (new \DateTime())->format('Y'))
            $elements[] = $date->format('o');

        return implode(' ', $elements);
    }

    protected function trans($key, array $params = array())
    {
        return $this->translator->trans($key, $params, 'dates');
    }

    public function getName()
    {
        return 'date_extension';
    }
} 