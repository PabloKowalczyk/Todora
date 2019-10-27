<?php

declare(strict_types=1);

namespace Todora\Tests\TestCase\EntityLoader;

use Doctrine\DBAL\Connection;
use Todora\Tests\TestCase\Entity\User;

final class DbalEntityLoader implements EntityLoaderInterface
{
    /** @var Connection */
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function loadEntities(object ...$entities): void
    {
        $this->purge();

        foreach ($entities as $entity) {
            $this->loadEntity($entity);
        }
    }

    public function purge(): void
    {
        foreach (self::TABLES_TO_PURGE as $tableName) {
            $this->connection
                ->exec("DELETE FROM {$tableName}")
            ;
        }
    }

    private function loadEntity(object $entity): void
    {
        switch (\get_class($entity)) {
            case User::class:
                /* @var $entity User */
                $this->connection
                    ->insert(
                        'users',
                        [
                            'id' => $entity->id(),
                            'email' => $entity->email(),
                            'password' => $entity->passwordHash(),
                            'username' => $entity->username(),
                            'created_at' => $entity->createdAt(),
                            'updated_at' => $entity->createdAt(),
                            'roles' => \json_encode($entity->roles()),
                            'verified' => $entity->verified(),
                        ]
                    )
                ;

                break;
        }
    }
}
