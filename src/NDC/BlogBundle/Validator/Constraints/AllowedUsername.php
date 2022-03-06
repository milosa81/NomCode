<?php


namespace NDC\BlogBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class AllowedUsername extends Constraint
{
    public $message = "Ce pseudo est réservé.";
    public $field = "username";

    public function validatedBy()
    {
        return 'allowed_username';
    }
} 