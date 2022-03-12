<?php

namespace NDC\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use NDC\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var User
     * @Assert\NotBlank()
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
     * @var string
     */
    private $slug;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $html;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $state;

    /**
     * @var \NDC\BlogBundle\Entity\Category
     * @Assert\NotBlank()
     */
    private $category;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tech;
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $comments;
    /**
     * @var \NDC\BlogBundle\Entity\Demo
     */
    private $demo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->state     = "draft";
        $this->tech      = new ArrayCollection();
        $this->comments  = new ArrayCollection();
        $this->views     = 0;
    }

    public function __toString()
    {
        return $this->title == null ? '' : $this->title;
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
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Article
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get html
     *
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * Set html
     *
     * @param string $html
     * @return Article
     */
    public function setHtml($html)
    {
        $this->html = $html;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Article
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get category
     *
     * @return \NDC\BlogBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param \NDC\BlogBundle\Entity\Category $category
     * @return Article
     */
    public function setCategory(\NDC\BlogBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Add tech
     *
     * @param \NDC\BlogBundle\Entity\Tech $tech
     * @return Article
     */
    public function addTech(\NDC\BlogBundle\Entity\Tech $tech)
    {
        $this->tech[] = $tech;

        return $this;
    }

    /**
     * Remove tech
     *
     * @param \NDC\BlogBundle\Entity\Tech $tech
     */
    public function removeTech(\NDC\BlogBundle\Entity\Tech $tech)
    {
        $this->tech->removeElement($tech);
    }

    /**
     * Get tech
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTech()
    {
        return $this->tech;
    }

    /**
     * Add comments
     *
     * @param \NDC\BlogBundle\Entity\Comment $comments
     * @return Article
     */
    public function addComment(\NDC\BlogBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \NDC\BlogBundle\Entity\Comment $comments
     */
    public function removeComment(\NDC\BlogBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
    /**
     * @var integer
     */
    private $views;


    /**
     * Set views
     *
     * @param integer $views
     * @return Article
     */
    public function setViews($views)
    {
        $this->views = $views;

        return $this;
    }

    /**
     * Get views
     *
     * @return integer 
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * Set demo
     *
     * @param \NDC\BlogBundle\Entity\Demo $demo
     * @return Article
     */
    public function setDemo(\NDC\BlogBundle\Entity\Demo $demo = null)
    {
        $this->demo = $demo;

        return $this;
    }

    /**
     * Get demo
     *
     * @return \NDC\BlogBundle\Entity\Demo 
     */
    public function getDemo()
    {
        return $this->demo;
    }
}
