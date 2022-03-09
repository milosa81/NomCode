<?php


namespace NDC\BlogBundle\Controller;

use NDC\BlogBundle\Entity\Article;
use NDC\BlogBundle\Entity\CommentMonitoring;
use NDC\BlogBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentAdminController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * @Template
     */
    public function indexAction(Request $request)
    {
        $unseen = $this->em->getRepository('NDCBlogBundle:Comment')->findUnseen($this->getUser());

        $comments = $this->paginator->paginate(
            $this->em->getRepository('NDCBlogBundle:Comment')->queryAll(),
            $request->query->get('page', 1),
            50
        );

        return array(
            'unseen' => $unseen,
            'comments' => $comments,
        );
    }
} 