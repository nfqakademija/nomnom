<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 4/6/14
 * Time: 2:46 PM
 */

namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddUsersToEventType extends AbstractType{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'adduserstoevent';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('emails', 'collection', array(
            // each item in the array will be an "email" field
            'type'   => 'email',
            // these options are passed to each "email" type
            'options'  => array(
                'required'  => false,
                'attr'      => array('class' => 'email-box')
            ),

            'allow_add' => true,
            'prototype' => true,
        ))
        ->add('submit', 'submit');;
    }
}