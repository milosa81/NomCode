<?php

namespace NDC\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NDC\UserBundle\Entity\User;

/**
 * Article
 */
class Article
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var User
     */
    private $author;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $techs;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->techs = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get author
     *
     * @return \NDC\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set author
     *
     * @param \NDC\UserBundle\Entity\User $author
     * @return Article
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;

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
     * @return Article
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Article
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Add techs
     *
     * @param \NDC\BlogBundle\Entity\Tech $techs
     * @return Article
     */
    public function addTech(\NDC\BlogBundle\Entity\Tech $techs)
    {
        $this->techs[] = $techs;

        return $this;
    }

    /**
     * Remove techs
     *
     * @param \NDC\BlogBundle\Entity\Tech $techs
     */
    public function removeTech(\NDC\BlogBundle\Entity\Tech $techs)
    {
        $this->techs->removeElement($techs);
    }

    /**
     * Get techs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTechs()
    {
        return $this->techs;
    }
}
