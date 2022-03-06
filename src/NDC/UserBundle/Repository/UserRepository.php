<?php

namespace NDC\UserBundle\Repository;

use Doctrine\ORM\EntityRepository;
use NDC\UserBundle\Entity\User;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function queryAll()
    {
        return $this->createQueryBuilder('u');
    }

    public function isFieldTaken($field, $value, User $user = null)
    {
        return $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->where("u.$field = :value")
            ->setParameter('value', $value)
            ->andWhere('u.id != :id')
            ->setParameter('id', $user === null ? 0 : $user->getId())
            ->getQuery()
            ->getSingleScalarResult() > 0;
    }
}
