<?php


namespace Nfq\NomNomBundle\Form\Type;


use Doctrine\Common\Collections\ArrayCollection;
use Nfq\NomNomBundle\Form\EventListener\AddFieldNumberSubscriber;
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
        $builder->addEventSubscriber(new AddFieldNumberSubscriber());
        $builder->add('selectSELECT', 'submit');
    }
}