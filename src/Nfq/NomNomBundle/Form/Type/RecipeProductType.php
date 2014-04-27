<?php
/**
 * Created by PhpStorm.
 * User: Andrius
 * Date: 4/27/14
 * Time: 12:12 PM
 */

namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RecipeProductType extends AbstractType {

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'recipeproduct';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('myProduct', 'genemu_jqueryselect2_entity', array(
            'class' => 'NfqNomNomBundle:MyProduct',
            'property' => 'productName',))
            ->add('quantityMeasure')
            ->add('quantity');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nfq\NomNomBundle\Entity\MyRecipeProduct',
            'cascade_validation' => true,
        ));
    }
}