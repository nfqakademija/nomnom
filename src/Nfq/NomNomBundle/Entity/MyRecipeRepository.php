<?php

namespace Nfq\NomNomBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MyRecipesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MyRecipeRepository extends EntityRepository
{

    /**
     * Returns total recipes count
     *
     * @return \Doctrine\ORM\Query
     */
    public function getRecipesCount()
    {
        $q = $this->createQueryBuilder('r')
            ->select('count(r.id)');

        return $q->getQuery()->getSingleScalarResult();
    }

    /**
     * Returns recipes query
     *
     * @return \Doctrine\ORM\Query
     */
    public function getRecipesQuery()
    {
        $q = $this->createQueryBuilder('r')
            ->select('r');

        return $q->getQuery();
    }



    public function filterByCategory($id1, $id2, $id3, $id4, $servfrom, $servto, $prepfrom, $prepto)
    {
        $id1 = $id1 ? 'Side dish' : ' ';
        $id2 = $id2 ? 'Main dish' : ' ';
        $id3 = $id3 ? 'Deserts' : ' ';
        $id4 = $id4 ? 'Soups' : ' ';

        if ($servfrom === NULL){
            $servfrom = 0;
        }
        if ($servto === NULL){
            $servto = 9999;
        }


        if ($prepto === '00:00:00'){
            $prepto = '23:59:59';
        }
        $query = $this->getEntityManager()
            ->createQuery(
                'SELECT p
                 FROM NfqNomNomBundle:MyRecipe p
                 JOIN p.myRecipeCategory c
                    WITH c.categoryName = :id1 OR c.categoryName = :id2 OR c.categoryName = :id3 OR c.categoryName = :id4
                 WHERE p.numberOfServings >= :servfrom AND p.numberOfServings <= :servto
                    AND p.preparationTime >= :prepfrom AND p.preparationTime <= :prepto
                '
            )->setParameter('id1', $id1)
            ->setParameter('id2', $id2)
            ->setParameter('id3', $id3)
            ->setParameter('id4', $id4)
            ->setParameter('servfrom', $servfrom)
            ->setParameter('servto', $servto)
            ->setParameter('prepfrom', $prepfrom)
            ->setParameter('prepto', $prepto)

        ;

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
