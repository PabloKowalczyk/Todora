<?php

declare(strict_types=1);

namespace Todora\Todos\Infrastructure\Doctrine;

use Doctrine\DBAL\Connection;
use Todora\Todos\Application\Query\UniqueUsernameQueryInterface;
use Todora\Todos\Application\Query\UniqueUsernameView;

class DbalUniqueUsernameQuery implements UniqueUsernameQueryInterface
{
    /** @var Connection */
    private $dbal;

    public function __construct(Connection $dbal)
    {
        $this->dbal = $dbal;
    }

    public function execute(string $username): UniqueUsernameView
    {
        $queryBuilder = $this->dbal
            ->createQueryBuilder();

        $queryBuilder
            ->select('COUNT(id) AS username_count')
            ->from('users')
            ->where('LOWER(:username) = LOWER(username)')
            ->setParameter('username', $username)
        ;

        $data = $this->dbal
            ->fetchAssoc(
                $queryBuilder->getSQL(),
                $queryBuilder->getParameters(),
                $queryBuilder->getParameterTypes()
            )
        ;

        return new UniqueUsernameView($data['username_count'] ?? 0);
    }
}
