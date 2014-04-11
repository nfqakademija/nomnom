<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MyEventRecipeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MyEventRecipeRepository extends EntityRepository
{
    public function findByEvent($eventId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT r FROM NfqNomNomBundle:MyEventRecipe r WHERE r.myEvent = :myevent')
            ->setParameter('myevent', $eventId)
            ->getResult();
    }

    public function findByEventAndRecipe($eventId, $recipeId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT r FROM NfqNomNomBundle:MyEventRecipe r
             WHERE r.myEvent = :myevent AND r.myRecipe = :myrecipe')
            ->setParameters(array('myevent' => $eventId,
                                'myrecipe' => $recipeId))
            ->getResult();
    }
}
