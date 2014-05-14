<?php
/**
 * Created by PhpStorm.
 * User: MDSKLLZ
 * Date: 14.5.14
 * Time: 04.09
 */

namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddToBrowseRecipesType extends AbstractType
{
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'addtobrowserecipes';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('myProduct', 'genemu_jqueryselect2_entity', array(
            'class' => 'NfqNomNomBundle:MyProduct',
            'property' => 'productName',));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nfq\NomNomBundle\Entity\MyRecipeProduct',
            'cascade_validation' => true,
        ));
    }
}