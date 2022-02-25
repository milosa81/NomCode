<?php


namespace NDC\BlogBundle\Controller;

use NDC\BlogBundle\Entity\Category;
use NDC\BlogBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use Symfony\Component\HttpFoundation\Request;

class CategoryAdminController extends Controller
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
        $categories = $this->paginator->paginate(
            $this->em->getRepository('NDCBlogBundle:Category')->queryAll(),
            $request->query->get('page', 1),
            30
        );

        return array(
            'categories' => $categories,
        );
    }

    /**
     * @Template
     */
    public function addAction(Request $request)
    {
        $category = new Category();

        return $this->handleForm($category, $request);
    }

    /**
     * @Template
     */
    public function editAction(Category $category, Request $request)
    {
        return $this->handleForm($category, $request);
    }

    private function handleForm(Category $category, Request $request = null)
    {
        $form = $this->createForm(new CategoryType, $category);

        if($request != null && $request->isMethod('POST')){
            $form->handleRequest($request);

            if($form->isValid()){
                $this->em->persist($category);
                $this->em->flush();

                $this->addFlash('success', 'Catégorie mise-à-jour.');

                return $this->redirect($this->generateUrl('blog_category_admin_index'));
            }
        }

        return array(
            'form' => $form->createView(),
            'category' => $category,
        );
    }
} 