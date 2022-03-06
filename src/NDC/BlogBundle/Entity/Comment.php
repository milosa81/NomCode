<?php

namespace NDC\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NDC\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;
use NDC\BlogBundle\Validator\Constraints as NDCAssert;

/**
 * Comment
 */
class Comment
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @NDCAssert\AllowedUsername()
     */
    private $username;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email()
     * @NDCAssert\AllowedUsername(
     *     field="email",
     *     message="Cette adresse mail est réservée."
     * )
     */
    private $email;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $message;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \NDC\BlogBundle\Entity\Article
     */
    private $article;

    /**
     * @var boolean
     */
    private $isRegistered;

    public function __construct(Article $article = null, User $user = null)
    {
        $this->article = $article;
        $this->isRegistered = false;

        if($user != null){
            $this->username = $user->getUsername();
            $this->email = $user->getEmail();
        }
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
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Comment
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Comment
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getMd5()
    {
        return md5(strtolower(trim($this->email)));
    }

    public function getIdentifier()
    {
        return abs(crc32($this->email));
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Comment
     */
    public function setMessage($message)
    {
        $this->message = $message;

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
     * @return Comment
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
     * @return Comment
     */
    public function setArticle(\NDC\BlogBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get isRegistered
     *
     * @return boolean
     */
    public function getIsRegistered()
    {
        return $this->isRegistered;
    }

    /**
     * Set isRegistered
     *
     * @param boolean $isRegistered
     * @return Comment
     */
    public function setIsRegistered($isRegistered)
    {
        $this->isRegistered = $isRegistered;

        return $this;
    }
}
