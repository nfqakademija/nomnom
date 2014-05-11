<?php
/**
 * Created by PhpStorm.
 * User: Pimpackiukas
 * Date: 5/11/14
 * Time: 12:35 PM
 */

namespace Nfq\NomNomBundle\Validator\Constraints;


use Nfq\NomNomBundle\Entity\MyEvent;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CausalityConstraintsValidator extends ConstraintValidator
{

    /**
     * Checks if the passed value is valid.
     *
     * @param MyEvent $eventForm
     * @param CausalityConstraints $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($eventForm, Constraint $constraint)
    {
        $eventPlanningDate = $eventForm->getEventPlanningDueDate();
        $eventDate = $eventForm->getEventDate();

        if ($eventPlanningDate > $eventDate) {
            $this->context->addViolation(
                $constraint->message
            );
        }
    }
}