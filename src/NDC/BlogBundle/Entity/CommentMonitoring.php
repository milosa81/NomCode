<?php

namespace NDC\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NDC\UserBundle\Entity\User;

/**
 * CommentMonitoring
 */
class CommentMonitoring
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $lastViewed;

    /**
     * @var \NDC\UserBundle\Entity\User
     */
    private $user;

    /**
     * @var \NDC\BlogBundle\Entity\Article
     */
    private $article;

    public function __construct(User $user = null, Article $article = null)
    {
        $this->user = $user;
        $this->article = $article;
        $this->lastViewed = new \DateTime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get lastViewed
     *
     * @return \DateTime
     */
    public function getLastViewed()
    {
        return $this->lastViewed;
    }

    /**
     * Set lastViewed
     *
     * @param \DateTime $lastViewed
     * @return CommentMonitoring
     */
    public function setLastViewed($lastViewed)
    {
        $this->lastViewed = $lastViewed;

        return $this;
    }

    /**
     * Get user
     *
     * @return \NDC\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set user
     *
     * @param \NDC\UserBundle\Entity\User $user
     * @return CommentMonitoring
     */
    public function setUser(\NDC\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get article
     *
     * @return \NDC\BlogBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set article
     *
     * @param \NDC\BlogBundle\Entity\Article $article
     * @return CommentMonitoring
     */
    public function setArticle(\NDC\BlogBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }
}
