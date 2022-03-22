<?php


namespace NDC\BlogBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact 
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $from;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min = "5",
     *     minMessage = "Le message doit faire {{ limit }} caractères minimum.",
     * )
     */
    private $message;

    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
} 