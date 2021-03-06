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

class ArticleAdminController extends Controller
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
        $articles = $this->paginator->paginate(
            $this->em->getRepository('NDCBlogBundle:Article')->queryAllNotDraft(),
            $request->query->get('page', 1),
            30
        );

        return array(
            'articles' => $articles,
            'drafts' => $this->em->getRepository('NDCBlogBundle:Article')->findByState('draft'),
        );
    }

    /**
     * @Template
     */
    public function addAction(Request $request)
    {
        $article = new Article;
        $article->setAuthor($this->getUser());

        return $this->handleForm($article, $request, true);
    }

    /**
     * @Template
     */
    public function editAction(Article $article, Request $request)
    {
        return $this->handleForm($article, $request);
    }

    private function handleForm(Article $article, Request $request = null, $add = false)
    {
        $form = $this->createForm(new ArticleType($article), $article);
        $oldDemo = $article->getDemo();
        if($oldDemo !== null)       
            $oldDemo->setArticle(null);

        if($request != null && $request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){

                $this->em->persist($article);
                if($oldDemo !== null)
                    $this->em->persist($oldDemo);
                if($article->getDemo() !== null){
                    $article->getDemo()->setArticle($article);
                    $this->em->persist($article->getDemo());
                }
                $this->em->flush();

                if($add){
                    $users = $this->em->getRepository('NDCUserBundle:User')->findAll();

                    foreach($users as $user)
                        $this->em->persist(new CommentMonitoring($user, $article));
                    $this->em->flush();
                }

                if($request->query->get('r', null) == 'ajax')
                    return new Response();

                $this->addFlash('success', 'Article mis-??-jour.');

                return $this->redirect($this->generateUrl('blog_article_admin_index'));
            }
        }

        if($request->query->get('r', null) == 'ajax')
            return new Response('', 400);

        return array(
            'form' => $form->createView(),
            'article' => $article,
        );
    }
} 