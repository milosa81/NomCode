<?php


namespace NDC\BlogBundle\Controller;

use NDC\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BlogController extends Controller
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
    public function indexAction(Request $request, $page)
    {
        $articles = $this->paginator->paginate(
            $this->em->getRepository('NDCBlogBundle:Article')->queryAllPublished(),
            $page,
            10
        );

        return array(
            'articles' => $articles,
        );
    }

    /**
     * @Template
     */
    public function articleAction(Article $article, $slug)
    {
        if($article->getState() != 'published') {
            if($this->getUser() != $article->getAuthor() and !$this->isGranted('ROLE_ADMIN'))
                if($article->getState() == 'removed')
                    throw new HttpException(410);
                else
                    throw $this->createNotFoundException();
        }

        if($article->getSlug() != $slug)
            return $this->redirect($this->generateUrl('blog_article', array('id'=>$article->getId(), 'slug'=>$article->getSlug())), 301);

        return array();
    }

    /**
     * @Template
     */
    public function cguAction() { return array(); }

    /**
     * @Template
     */
    public function authorsAction() { return array(); }
} 