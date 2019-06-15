<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * MissionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MissionRepository extends EntityRepository
{
    public function findByCurrentUser($user) {
        $query = $this->createQueryBuilder("m");
        if(!$user->isAdmin()) {
            $query = $query->where("m.client = :client")
                            ->setParameter(":client", $user);
        }
        $query = $query->orderBy("m.serviceDate","DESC");

        return $query->getQuery();
    }
}
