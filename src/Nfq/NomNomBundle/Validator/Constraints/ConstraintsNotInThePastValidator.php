<?php

namespace Nfq\NomNomBundle\Validator\Constraints;


use DateTime;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintsNotInThePastValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        $now = new DateTime();
        if ($value < $now) {
            $this->context->addViolation(
                $constraint->message
            );
        }
    }
}