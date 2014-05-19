<?php


namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DisplayRecipeType extends AbstractType
{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'displayrecipe';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('myProduct', 'genemu_jqueryselect2_entity', array(
            'class' => 'NfqNomNomBundle:MyProduct',
            'property' => 'productName',))

            ->add('select');
    }
}