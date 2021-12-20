<?php


namespace NDC\BlogBundle\Controller;

use NDC\BlogBundle\Entity\Tech;
use NDC\BlogBundle\Form\TechType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use Symfony\Component\HttpFoundation\Request;

class TechAdminController extends Controller
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
     * @var UploadableManager
     */
    private $uploadableManager;

    /**
     * @Template
     */
    public function indexAction(Request $request)
    {
        $tech = $this->paginator->paginate(
            $this->em->getRepository('NDCBlogBundle:Tech')->queryAll(),
            $request->query->get('page', 1),
            30
        );

        return array(
            'techs' => $tech,
        );
    }

    /**
     * @Template
     */
    public function addAction(Request $request)
    {
        $tech = new Tech;

        return $this->handleForm($tech, $request);
    }

    /**
     * @Template
     */
    public function editAction(Tech $tech, Request $request)
    {
        return $this->handleForm($tech, $request);
    }

    private function handleForm(Tech $tech, Request $request = null)
    {
        $form = $this->createForm(new TechType, $tech);

        if($request != null && $request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $this->em->persist($tech);
                if($tech->getFile())
                    $this->uploadableManager->markEntityToUpload($tech, $tech->getFile());
                $this->em->flush();

                $this->addFlash('success', 'Techno mis-à-jour.');

                return $this->redirect($this->generateUrl('blog_tech_admin_index'));
            }
        }

        return array(
            'form' => $form->createView(),
            'tech' => $tech,
        );
    }
} 