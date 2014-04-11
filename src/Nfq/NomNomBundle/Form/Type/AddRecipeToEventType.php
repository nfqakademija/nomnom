<?php
/**
 * Created by PhpStorm.
 * User: Pimpackiukas
 * Date: 4/11/14
 * Time: 2:28 PM
 */

namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AddRecipeToEventType extends AbstractType {
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'addrecipetoevent';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recipe', 'genemu_jqueryselect2_entity', array(
            'class' => 'NfqNomNomBundle:MyRecipe',
            'property' => 'recipeName',
        ))
            ->add('submit', 'submit');;
    }
} 