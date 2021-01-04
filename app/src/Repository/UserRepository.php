<?php declare(strict_types=1);
namespace App\Repository;

/**
 * @method \App\Entity\User|null find($id, $lockMode = null, $lockVersion = null)
 * @method \App\Entity\User|null findOneBy(array $criteria, array $orderBy = null)
 * @method \App\Entity\User[]    findAll()
 * @method \App\Entity\User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends \Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository
{
    public function __construct( \Doctrine\Persistence\ManagerRegistry $registry)
    {
        parent::__construct($registry, \App\Entity\User::class);
    }

    /**
     *  Отримання масиву значень за обраним полем
     *
     * @param string $column
     *
     * @return array
     */

    public function findAllByFields( string $column ): array
    {
        $column_search = "u.$column";

        $result = $this->createQueryBuilder('u')
            ->select( $column_search )
            ->getQuery()
            ->getResult();

        return array_column( $result, $column );
    }
}