<?php

namespace App\Repository;

use App\Entity\Bed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bed>
 *
 * @method Bed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bed[]    findAll()
 * @method Bed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bed::class);
    }

    public function save(Bed $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Bed $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}
