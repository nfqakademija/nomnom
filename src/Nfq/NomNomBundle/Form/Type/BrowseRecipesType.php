<?php


namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class BrowseRecipesType extends AbstractType
{
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'browserecipes';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('side', 'checkbox', array(
                'label'     => 'Side dish',
                'required'  => false,
            ))
            ->add('main', 'checkbox', array(
                'label'     => 'Main dish',
                'required'  => false,
            ))
            ->add('deserts', 'checkbox', array(
                'label'     => 'Deserts',
                'required'  => false,
            ))
            ->add('soups', 'checkbox', array(
                'label'     => 'Soups',
                'required'  => false,
            ))
            ->add('servfrom', 'integer', array(
                'label'     => 'Number of servings from',
            ))
            ->add('servto', 'integer', array(
                'label'     => 'to',
            ))
            ->add('prepfrom', 'time', array(
                'label'     => 'Preparation time from',
                'input'     => 'string',
            ))
            ->add('prepto', 'time', array(
                'label'     => 'to',
                'input'     => 'string',
            ))
            ->add('Browse', 'submit')
            ;
    }
}