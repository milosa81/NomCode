<?php

namespace NDC\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Demo
 */
class Demo
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $dependencies;

    /**
     * @var string
     */
    private $html;

    /**
     * @var string
     */
    private $css;

    /**
     * @var string
     */
    private $js;

    /**
     * @var Article
     */
    private $article;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function __toString()
    {
        return $this->name == null ? '' : $this->name;
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
     * Set name
     *
     * @param string $name
     * @return Demo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set dependencies
     *
     * @param string $dependencies
     * @return Demo
     */
    public function setDependencies($dependencies)
    {
        $this->dependencies = $dependencies;

        return $this;
    }

    /**
     * Get dependencies
     *
     * @return string 
     */
    public function getDependencies()
    {
        return $this->dependencies;
    }

    /**
     * Set html
     *
     * @param string $html
     * @return Demo
     */
    public function setHtml($html)
    {
        $this->html = $html;

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
     * Set css
     *
     * @param string $css
     * @return Demo
     */
    public function setCss($css)
    {
        $this->css = $css;

        return $this;
    }

    /**
     * Get css
     *
     * @return string 
     */
    public function getCss()
    {
        return $this->css;
    }

    /**
     * Set js
     *
     * @param string $js
     * @return Demo
     */
    public function setJs($js)
    {
        $this->js = $js;

        return $this;
    }

    /**
     * Get js
     *
     * @return string 
     */
    public function getJs()
    {
        return $this->js;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Demo
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Demo
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

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
     * Set article
     *
     * @param \NDC\BlogBundle\Entity\Article $article
     * @return Demo
     */
    public function setArticle(\NDC\BlogBundle\Entity\Article $article = null)
    {
        $this->article = $article;

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
}
