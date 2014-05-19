<?php


namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class DisplaySearchType extends AbstractType
{
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'displaysearch';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('displayrecipe', 'collection',
        array('type' => new DisplayRecipeType(),
            'allow_add' => true,
            'allow_delete' => true,))
        ->add('create', 'submit');
    }
}