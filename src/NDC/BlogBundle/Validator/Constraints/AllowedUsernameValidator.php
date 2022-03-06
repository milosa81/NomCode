<?php


namespace NDC\BlogBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class AllowedUsernameValidator extends ConstraintValidator
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var SecurityContext
     */
    private $ctx;

    public function __construct(EntityManager $em, SecurityContext $context)
    {
        $this->em = $em;
        $this->ctx = $context;
    }

    public function validate($value, Constraint $constraint)
    {
        $user = $this->ctx->getToken()->getUser();
        if(is_string($user))
            $user = null;

        if ($this->em->getRepository('NDCUserBundle:User')->isFieldTaken($constraint->field, $value, $user)) {
            $this->context
                ->buildViolation($constraint->message)
                ->addViolation();
        }
    }
} 