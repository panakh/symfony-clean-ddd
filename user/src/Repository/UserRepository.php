<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Hash\User\UserRepositoryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository  implements UserRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByUsername(string $username): \Hash\User\User
    {
        $persistenceModel = $this->findOneBy([
            'username' => $username,
        ]);

        $user = new \Hash\User\User($persistenceModel->getUsername());
        foreach ($persistenceModel->getTodos() as $todo) {
            $user->addTodo($todo->getId(), $todo->getDescription());
        }

        return $user;
    }

    public function saveUser(\Hash\User\User $user): void
    {
        /** @var User $persistenceModel */
        $persistenceModel = $this->findOneBy([
            'username' => $user->getUsername(),
        ]);

        $persistenceModel->syncFromDomainModel($user);

        $this->getEntityManager()->persist($persistenceModel);
        $this->getEntityManager()->flush();
    }
}
