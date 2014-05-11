<?php
/**
 * Created by PhpStorm.
 * User: Andrius
 * Date: 5/11/14
 * Time: 12:35 PM
 */

namespace Nfq\NomNomBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class CausalityConstraints extends Constraint
{
    public $message = 'Event planning date has te be before event date';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}