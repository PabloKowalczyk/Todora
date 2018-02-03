<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Symfony\UserProvider;

use Doctrine\DBAL\Connection;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class DbalUserProvider implements UserProviderInterface
{
    /**
     * @var Connection
     */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username): User
    {
        $queryBuilder = $this->connection
            ->createQueryBuilder();

        $queryBuilder
            ->select('*')
            ->from('users', 'u')
            ->where('u.email = :email')
            ->setParameter('email', $username);

        $userData = $this->connection
            ->fetchAssoc(
                $queryBuilder->getSQL(),
                $queryBuilder->getParameters(),
                $queryBuilder->getParameterTypes()
            );

        if ($userData === false) {
            $exception = new UsernameNotFoundException();

            $exception->setUsername($username);

            throw $exception;
        }

        return new User(
            $userData['email'],
            $userData['password'],
            \json_decode($userData['roles'])
        );
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user): UserInterface
    {
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class): bool
    {
        return User::class === $class;
    }
}
