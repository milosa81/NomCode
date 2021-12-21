<?php


namespace NDC\BlogBundle\Controller;

use Doctrine\ORM\EntityManager;
use NDC\BlogBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\NamePrefix;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * @NamePrefix("api_")
 */
class ArticleApiController extends Controller
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
     * @ApiDoc(
     *  resource=true,
     *  description="Find Article by its id",
     *  section="Articles",
     *  output="NDC\BlogBundle\Entity",
     *  requirements={
     *      {"name"="id", "dataType"="integer", "required"=true, "description"="Article's id"}
     *  }
     * )
     */
    public function getArticleAction($id)
    {
        $article = $this->em->getRepository('NDCBlogBundle:Article')->findOneById($id);

        return $article;
    }
} 