<?php
/**
 * Created by PhpStorm.
 * User: MDSKLLZ
 * Date: 14.5.20
 * Time: 08.04
 */

namespace Nfq\NomNomBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AddFieldNumberSubscriber implements EventSubscriberInterface{

    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $recipes = $event->getData();
        $form = $event->getForm();

        if ($recipes->getId() > 0) {
            $form->add('name', 'text');

            $form->add('side', 'checkbox', array(
                'label'     => 'Side dish',
                'required'  => false,
            ));
        }
    }

} 