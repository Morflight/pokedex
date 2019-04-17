<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PokemonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PokemonRepository extends EntityRepository
{
    public function findBySpecies($speciesId)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.species = :speciesId')
            ->andWhere('p.default = 1')
            ->setParameter('speciesId', $speciesId)
            ->getQuery();

        return $qb->execute();
    }
}
