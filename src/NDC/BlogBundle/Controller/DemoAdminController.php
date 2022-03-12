<?php


namespace NDC\BlogBundle\Controller;

use NDC\BlogBundle\Entity\Demo;
use NDC\BlogBundle\Form\DemoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class DemoAdminController extends Controller
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
        $demos = $this->paginator->paginate(
            $this->em->getRepository('NDCBlogBundle:Demo')->queryAll(),
            $request->query->get('page', 1),
            30
        );

        return array(
            'demos' => $demos,
        );
    }

    /**
     * @Template
     */
    public function addAction(Request $request)
    {
        $demo = new Demo();

        return $this->handleForm($demo, $request);
    }

    /**
     * @Template
     */
    public function editAction(Demo $demo, Request $request)
    {
        return $this->handleForm($demo, $request);
    }

    private function handleForm(Demo $demo, Request $request = null)
    {
        $form = $this->createForm(new DemoType($demo), $demo);

        if($request != null && $request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $this->em->persist($demo);
                $this->em->flush();

                $this->addFlash('success', 'Démo mise-à-jour.');

                return $this->redirect($this->generateUrl('blog_demo_admin_index'));
            }
        }

        return array(
            'form' => $form->createView(),
            'demo' => $demo,
        );
    }
} 