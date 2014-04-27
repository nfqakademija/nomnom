<?php
namespace Nfq\NomNomBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ConstraintsNotInThePast extends Constraint
{
    public $message = 'You cannot create an event with a date in the past.';

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
} 