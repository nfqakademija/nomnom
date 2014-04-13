<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MyRecipeVoteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MyRecipeVoteRepository extends EntityRepository
{
    public function findExisting($userEventId, $eventRecipeId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT r FROM NfqNomNomBundle:MyRecipeVote r
            WHERE r.myUserEvent = :userEvent AND r.myEventRecipe = :eventRecipe')
            ->setParameters(array('userEvent' => $userEventId,
                                    'eventRecipe' => $eventRecipeId))
            ->getResult();
    }

    public function findByEventRecipe($eventRecipeId)
    {
        return $this->getEntityManager()
            ->createQuery('SELECT r FROM NfqNomNomBundle:MyRecipeVote r
            WHERE r.myEventRecipe = :eventRecipe')
            ->setParameter('eventRecipe' , $eventRecipeId)
            ->getResult();
    }
}
