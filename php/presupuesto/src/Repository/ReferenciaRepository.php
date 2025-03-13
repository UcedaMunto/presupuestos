<?php

namespace App\Repository;

use App\Entity\Referencia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Referencia>
 */
class ReferenciaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Referencia::class);
    }

    //    /**
    //     * @return Referencia[] Returns an array of Referencia objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Referencia
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function findByCodigoPartial(string $codigo)
    {
        return $this->createQueryBuilder('r')
            ->where('r.codigo LIKE :codigo')
            ->setParameter('codigo', '%' . $codigo . '%')
            ->orderBy('r.codigo', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByTerm(string $term = '')
    {
        $qb = $this->createQueryBuilder('r');
        
        if ($term) {
            $qb->where('r.codigo LIKE :term OR r.codigo LIKE :term')
               ->setParameter('term', '%' . $term . '%');
        }
        
        return $qb->orderBy('r.codigo', 'ASC')
                 ->setMaxResults(20)
                 ->getQuery()
                 ->getResult();
    }
}
