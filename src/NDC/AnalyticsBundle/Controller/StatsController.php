<?php

namespace NDC\AnalyticsBundle\Controller;

use NDC\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class StatsController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    public function articleAction(Article $article)
    {
        $now = new \DateTime;
        $now->setTime(0,0);

        $from = new \DateTime;
        $from->setTime(0,0);
        $from->modify('-20 days');

        $render_simple = $this->renderView('@NDCBlog/Admin/_chart.html.twig', array(
            'selector' => 'chart-simple-'.$article->getId(),
            'title' => 'Vues',
            'data' => $this->em->getRepository('NDCAnalyticsBundle:View')->articleStats($article, $from, $now),
        ));

        $render_cumulative = $this->renderView('@NDCBlog/Admin/_chart.html.twig', array(
            'selector' => 'chart-cumulative-'.$article->getId(),
            'title' => 'Vues cumulées',
            'data' => $this->em->getRepository('NDCAnalyticsBundle:View')->articleCumulativeStats($article, $from, $now),
            'type' => 'line',
        ));

        return new Response('<div class="row"><div class="col-md-6 col-sm-12">'.$render_simple.'</div><div class="col-md-6 col-xs-12">'.$render_cumulative.'</div></div>');
    }
}
