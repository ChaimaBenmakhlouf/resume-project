<?php

namespace App\Repository;

use App\Entity\LanguageSpoken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LanguageSpoken>
 *
 * @method LanguageSpoken|null find($id, $lockMode = null, $lockVersion = null)
 * @method LanguageSpoken|null findOneBy(array $criteria, array $orderBy = null)
 * @method LanguageSpoken[]    findAll()
 * @method LanguageSpoken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LanguageSpokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LanguageSpoken::class);
    }

    public function add(LanguageSpoken $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LanguageSpoken $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LanguageSpoken[] Returns an array of LanguageSpoken objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LanguageSpoken
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
