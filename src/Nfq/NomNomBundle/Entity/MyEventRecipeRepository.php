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

    /**
     * Selects event recipes and joins recipe in order to get event recipes with recipe together
     *
     * @param $eventId
     * @param bool $filter
     * @return array
     */
    public function findByEventWithRecipe($eventId, $filter = false)
    {

        $query = '
                SELECT er
                FROM NfqNomNomBundle:MyEventRecipe er
                JOIN NfqNomNomBundle:MyRecipe r
                WHERE
                    er.myEvent = :myevent '. ($filter ? '  AND er.totalUpvote >= (r.numberOfServings/2) ' : '');

        return $this->getEntityManager()
            ->createQuery($query)
            ->setParameter('myevent', $eventId)
            ->getResult();
    }
}
