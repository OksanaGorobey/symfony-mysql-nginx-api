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
    /**
     * UserRepository constructor.
     * @param \Doctrine\Persistence\ManagerRegistry $registry
     */
    public function __construct(\Doctrine\Persistence\ManagerRegistry $registry )
    {
        parent::__construct($registry, \App\Entity\User::class);
    }

    ////////////////////////////////////////////////////////////////////////////

    /**
     *  Отримання масиву значень за обраним полем
     *
     * @param string $column
     *
     * @return array
     */

    public function findAllByFields( string $column ): array
    {
        $result = $this->createQueryBuilder('u')
            ->select( "u.$column" )
            ->getQuery()
            ->getResult();

        return array_column( $result, $column );
    }

    ////////////////////////////////////////////////////////////////////////////

    /**
     * Отримуємо користувача за будь яким із параметрів $nickname або $email
     *
     * @param string $nickname
     * @param string $email
     * @return array
     */
    public function findUserRegistration(string $nickname, string $email ): array
    {
        return $this->createQueryBuilder('u')
        ->where('u.nickname = :nickname')
        ->orWhere('u.email = :email')
        ->setParameter('nickname', $nickname)
        ->setParameter('email', $email)
        ->getQuery()
        ->getResult();
    }

    ////////////////////////////////////////////////////////////////////////////

    /**
     * Додавання нового користувача
     *
     * @param \Symfony\Component\Form\FormInterface $form
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function addUser(\Symfony\Component\Form\FormInterface $form ): void
    {
        $user = new \App\Entity\User();

        // ініціалізуємо обьект
        $user->setFirstname( $form['firstname']->getData() );
        $user->setLastname( $form['lastname']->getData() );
        $user->setNickname( $form['nickname']->getData() );
        $user->setPassword( $form['password']->getData() );
        $user->setEmail( $form['email']->getData() );
        $user->setAge( $form['age']->getData() );

        //додаємо до бд запис
        $this->getEntityManager()->persist( $user );
        $this->getEntityManager()->flush( );
    }

    ////////////////////////////////////////////////////////////////////////////

}