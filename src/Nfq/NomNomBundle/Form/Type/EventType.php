<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/4/14
 * Time: 5:46 PM
 */

namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class EventType extends AbstractType
{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'event';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('eventName')
            ->add('eventPlanningDueDate', 'collot_datetime', array('pickerOptions' =>
                array('minuteStep' => 15)))
            ->add('eventDate', 'collot_datetime', array('pickerOptions' =>
                array('minuteStep' => 15)))
            ->add('create', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nfq\NomNomBundle\Entity\MyEvent',
            'cascade_validation' => true,
        ));
    }
}