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

class AddUsersToEventType extends AbstractType
{

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
        $builder->add('user', 'genemu_jqueryselect2_entity', array(
            'class' => 'NfqNomNomBundle:User',
            'property' => 'username',
        ))
            ->add('submit', 'submit');;
    }
}