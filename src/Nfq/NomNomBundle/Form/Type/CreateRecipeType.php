<?php
/**
 * Created by PhpStorm.
 * User: Pimpackiukas
 * Date: 4/27/14
 * Time: 11:50 AM
 */

namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreateRecipeType extends AbstractType
{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'createrecipe';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('recipeName')
            ->add('numberOfServings')
            ->add('preparationTime')
            ->add('preparationInstructions', 'textarea')
            ->add('myRecipeCategory', 'genemu_jqueryselect2_entity', array(
                'class' => 'NfqNomNomBundle:MyRecipeCategory',
                'property' => 'categoryName',))
            ->add('image', 'file',
                array(
                    'label' => 'Select the photo you want to upload'
                )
            )
            ->add('myRecipeProducts', 'collection',
                array('type' => new RecipeProductType(),
                    'allow_add' => true,
                    'allow_delete' => true,))
            ->add('create', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nfq\NomNomBundle\Entity\MyRecipe',
            'cascade_validation' => true,
        ));
    }
}