<?php


namespace NDC\UserBundle\Controller;

use NDC\UserBundle\Entity\User;
use NDC\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\Paginator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

class UserAdminController extends Controller
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
        $users = $this->paginator->paginate(
            $this->em->getRepository('NDCUserBundle:User')->queryAll(),
            $request->query->get('page', 1),
            25
        );

        return array(
            'users' => $users,
        );
    }

    /**
     * @Template
     */
    public function addAction(Request $request)
    {
        $userManager = $this->get('fos_user.user_manager');
        $user  = $userManager->createUser();
        $form = $this->createForm(new UserType, $user);

        if($request->isMethod('post')){
            $form->handleRequest($request);

            if($form->isValid()){
                $userManager->updateUser($user);
                if($user->getFile() != null)
                    $this->uploadableManager->markEntityToUpload($user, $user->getFile());
                $userManager->updateUser($user);

                return $this->redirect($this->generateUrl('blog_user_admin_index'));
            }
        }

       return array(
           'form' => $form->createView(),
        );
    }

    /**
     * @Template
     */
    public function editAction(Request $request, User $user)
    {
        $form = $this->createForm(new UserType, $user);

        if($request->isMethod('post')){
            $form->handleRequest($request);

            if($form->isValid()){
                $userManager = $this->get('fos_user.user_manager');

                $userManager->updateUser($user);
                if($user->getFile() != null)
                    $this->uploadableManager->markEntityToUpload($user, $user->getFile());
                $userManager->updateUser($user);

                return $this->redirect($this->generateUrl('blog_user_admin_index'));
            }
        }

       return array(
           'form' => $form->createView(),
        );
    }
} 