<?php
/**
 * Created by PhpStorm.
 * User: Pimpackiukas
 * Date: 4/21/14
 * Time: 7:32 PM
 */

namespace Nfq\NomNomBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserProductType extends AbstractType
{
    private $suffix;
    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'userProduct' . $this->suffix;
    }

    public function __construct($userEventId, $recipeProductId)
    {
        $this->suffix = $userEventId . '_' . $recipeProductId;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('quantity')
            ->add('bring', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Nfq\NomNomBundle\Entity\MyUserProduct',
            'cascade_validation' => true,
        ));
    }
}