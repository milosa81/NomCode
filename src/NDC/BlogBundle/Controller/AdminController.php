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

        return array(
            'wip' => $wip,
            'future' => $future,
            'unseen' => $unseen,
        );
    }
}
