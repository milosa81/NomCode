<?php

namespace NDC\AnalyticsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NDC\BlogBundle\Entity\Article;

/**
 * View
 */
class View
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $sessionId;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \NDC\BlogBundle\Entity\Article
     */
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
        $this->createdAt = new \DateTime;
        $this->sessionId = session_id();
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
     * Get sessionId
     *
     * @return string
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * Set sessionId
     *
     * @param string $sessionId
     * @return View
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return View
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * @return View
     */
    public function setArticle(\NDC\BlogBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }
}
