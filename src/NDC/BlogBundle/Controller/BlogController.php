<?php


namespace NDC\BlogBundle\Controller;

use NDC\AnalyticsBundle\Entity\View;
use NDC\BlogBundle\Entity\Article;
use NDC\BlogBundle\Entity\Comment;
use NDC\BlogBundle\Entity\CommentMonitoring;
use NDC\BlogBundle\Entity\Contact;
use NDC\BlogBundle\Entity\Demo;
use NDC\BlogBundle\Form\CommentType;

use NDC\BlogBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpFoundation\Response;

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
            8
        );

        return array(
            'articles' => $articles,
        );
    }

    /**
     * @Template
     */
    public function articleAction($category, Article $article, $slug, Request $request)
    {
        // Check if readable
        $this->isArticleReadable($article);

        // Check slug
        if($article->getSlug() != $slug)
            return $this->redirect($this->generateUrl('blog_article', array('id'=>$article->getId(), 'category' => $article->getCategory()->getSlug(), 'slug'=>$article->getSlug())), 301);

        // Check category
        if($article->getCategory()->getSlug() != $category)
            return $this->redirect($this->generateUrl('blog_article', array('id'=>$article->getId(), 'category' => $article->getCategory()->getSlug(), 'slug'=>$article->getSlug())), 301);

        // View counter
        $view = new View($article, $this->get('session')->getId());
        if($this->getUser() === null){
            $this->em->persist($view);
            $this->em->flush();
        }

        // Comment monitoring
        if($this->getUser() !== null){
            $cm = $this->em->getRepository('NDCBlogBundle:CommentMonitoring')->findOne($article, $this->getUser());

            if($cm === null)
                $cm = new CommentMonitoring($this->getUser(), $article);

            $cm->setLastViewed(new \DateTime());
            $this->em->persist($cm);
            $this->em->flush();
        }

        // Post comment
        $comment = new Comment($article, $this->getUser());
        $form = $this->createForm(new CommentType($this->getUser()), $comment);

        if($request->query->get('r', null) == 'ajax') {
            if($request->isMethod('POST')){
                $form->handleRequest($request);

                if($form->isValid()){
                    if($this->isGranted('ROLE_ADMIN'))
                        $comment->setIsRegistered(true);

                    $this->em->persist($comment);
                    $this->em->flush();
                    
                    return $this->render('@NDCBlog/Blog/_comment.html.twig', array(
                        'comment' => $comment,
                    ));
                }
            }

            $intro_response = count(explode('ERROR: ', $form->getErrors()))-1 > 1 ? '<b>Il y a quelques erreurs dans ce formulaire !</b><br>' : '';
            return new Response($intro_response.str_replace("ERROR: ", "", nl2br($form->getErrors())), 400);
        }

        return array(
            'form' => $form->createView(),
            'view' => $view,
        );
    }

    /**
     * @Template
     */
    public function searchAction(Request $request)
    {
        $query = $request->query->get('q', '');
        $techs = $this->em->getRepository('NDCBlogBundle:Tech')->findAllSlug();
        $categories = $this->em->getRepository('NDCBlogBundle:Category')->findAllSlug();
        $users = $this->em->getRepository('NDCUserBundle:User')->findAllSlug();

        $searchQuery = $this->em->getRepository('NDCBlogBundle:Article')->querySearch($query, $techs, $categories, $users);

        $articles = $this->paginator->paginate(
            $searchQuery,
            $request->query->get('page', 1),
            8
        );

        return array(
            "query" => $query,
            'articles' => $articles,
            'page' => $request->query->get('page', 1),
        );
    }

    /**
     * @Template
     */
    public function demoAction(Demo $demo) {
        // Check if readable
        $article = $demo->getArticle();
        if(empty($article)) {
            if(!$this->isGranted('ROLE_ADMIN'))
                throw $this->createNotFoundException();
        } else {
            $this->isArticleReadable($article);
        }

        return array();
    }

    /**
     * @Template
     */
    public function authorsAction() {
        $authors = $this->em->getRepository('NDCUserBundle:User')->findBy(array("locked" => false, "expired" => false));

        return array(
            "authors" => $authors,
        );
    }

    /**
     * @Template
     */
    public function cguAction()
    {
        return array();
    }

    /**
     * @Template
     */
    public function faqAction()
    {
        return array();
    }

    /**
     * @Template
     */
    public function contactAction(Request $request)
    {
        $contact = new Contact;
        $form = $this->createForm(new ContactType, $contact);

        if($request->isMethod('post')){
            $form->handleRequest($request);

            if($form->isValid()){
                $to = $this->em->getRepository('NDCUserBundle:User')->findContacts();

                $message = \Swift_Message::newInstance()
                    ->setSubject('[NomDeCode] Nouveau message depuis le site web')
                    ->setFrom(array('contact@nomdeco.de' => 'NomDeCode'))
                    ->setTo($to)
                    ->setBody(
                        $this->renderView(
                            'NDCBlogBundle:Blog:email.txt.twig',
                            array(
                                'contact' => $contact,
                                'ip' => $_SERVER['REMOTE_ADDR'],
                            )
                        )
                    )
                ;
                $this->get('mailer')->send($message);

                $this->addFlash('success', 'Le message a bien été envoyé, nous lirons ça sous peu !');

                return $this->redirect($this->generateUrl('blog_contact'));
            }
        }

        return array(
            'form' => $form->createView(),
        );
    }

    private function isArticleReadable($article) {
        if($article->getState() != 'published' || $article->getCreatedAt() > new \DateTime()) {
            if($this->getUser() != $article->getAuthor() and !$this->isGranted('ROLE_ADMIN'))
                if($article->getState() == 'removed')
                    throw new HttpException(410);
                else
                    throw $this->createNotFoundException();
        }

        return true;
    }

    public function setViewSessionIdAction(View $view)
    {
        if($view->getSessionId() != '')
            throw new BadRequestHttpException;

        $view->setSessionId($this->get('session')->getId());
        $this->em->persist($view);
        $this->em->flush();

        return new Response('', 200);
    }
} 