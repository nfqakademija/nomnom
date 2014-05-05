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
    private $hidden;

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

    public function __construct($userEventId, $recipeProductId, $hidden = false)
    {
        $this->suffix = $userEventId . '_' . $recipeProductId;
        $this->hidden = $hidden;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $type = ($this->hidden ? 'hidden' : null);

        $options = ($this->hidden ? array('data' => 0) : array() );

        $builder
            ->add('quantity', $type, $options)
            ->add('bring', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Nfq\NomNomBundle\Entity\MyUserProduct',
                'cascade_validation' => true,
            )
        );
    }
}