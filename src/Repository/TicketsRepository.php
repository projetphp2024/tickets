<?php

namespace App\Repository;

use App\Entity\Tickets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tickets>
 *
 * @method Tickets|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tickets|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tickets[]    findAll()
 * @method Tickets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tickets::class);
    }

//    /**
//     * @return Tickets[] Returns an array of Tickets objects
//     */
   public function findTicketSolvedByUserId($userId): array
   {
       return $this->createQueryBuilder('t')
           ->andWhere('t.solvedBy = :val')
           ->setParameter('val', $userId)
           ->orderBy('t.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

   public function findTicketByUserId($userId): array
   {
       return $this->createQueryBuilder('t')
           ->andWhere('t.solvedBy = :val')
           ->setParameter('val', $userId)
           ->orderBy('t.id', 'ASC')
           ->getQuery()
           ->getResult()
       ;
   }

//    public function findOneBySomeField($value): ?Tickets
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
