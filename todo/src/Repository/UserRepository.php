<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Hash\Domain\Todo\Ports\UserRepositoryInterface;

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

    public function findByUsername(string $username): \Hash\Domain\Todo\User\User
    {
        $persistenceModel = $this->findOneBy([
            'username' => $username,
        ]);

        $user = new \Hash\Domain\Todo\User\User($persistenceModel->getUsername());
        foreach ($persistenceModel->getTodos() as $todo) {
            $user->addTodo($todo->getId(), $todo->getDescription());
        }

        return $user;
    }

    public function saveUser(\Hash\Domain\Todo\User\User $userAggregate): void
    {
        /** @var User $persistenceModel */
        $persistenceModel = $this->findOneBy([
            'username' => $userAggregate->getUsername(),
        ]);

        $persistenceModel->syncFromDomainModel($userAggregate);

        $this->removeRemovedTodos($persistenceModel, $userAggregate);

        $this->getEntityManager()->persist($persistenceModel);
        $this->getEntityManager()->flush();
    }

    private function removeRemovedTodos(User $persistenceModel, \Hash\Domain\Todo\User\User $aggregate)
    {
        $todoIds = array_map(function ($value) {
            return $value['id'];
        }, $aggregate->getTodos());

        foreach ($persistenceModel->getTodos() as $savedTodo) {
            if (!in_array($savedTodo->getId(), $todoIds)) {
                $persistenceModel->removeTodo($savedTodo);
                $this->getEntityManager()->remove($savedTodo);
            }
        }
    }
}
