<?php

namespace NDC\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AdminController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @Template
     */
    public function indexAction()
    {
        $wip = $this->em->getRepository('NDCBlogBundle:Article')->findBy(array(
            'author' => $this->getUser(),
            'state' => 'draft',
        ), array(
            'updatedAt' => 'DESC'
        ));

        $future = $this->em->getRepository('NDCBlogBundle:Article')->findFutureByAuthor($this->getUser());

        $unseen = $this->em->getRepository('NDCBlogBundle:Comment')->findUnseen($this->getUser());

        // Analytics
        $now = new \DateTime;
        $now->setTime(0,0);

        $from = new \DateTime;
        $from->setTime(0,0);
        $from->modify('-2 weeks');

        $stats = array(
            'readers' => $this->em->getRepository('NDCAnalyticsBundle:View')->readersStats($from, $now),
            'myreaders' => $this->em->getRepository('NDCAnalyticsBundle:View')->authorStats($this->getUser(), $from, $now),
            'persession' => $this->em->getRepository('NDCAnalyticsBundle:View')->articlesPerSessionStats($from, $now),
        );

        return array(
            'wip' => $wip,
            'future' => $future,
            'unseen' => $unseen,
            'stats' => $stats,
        );
    }
}
