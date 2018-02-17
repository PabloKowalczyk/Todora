<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

class CreateUniqueIndexOnUsername extends AbstractMigration
{
    public function up(): void
    {
        $usernameIndexName = AddUsersTable::USERNAME_INDEX_NAME;
        $tableName = AddUsersTable::TABLE_NAME;

        $table = $this->table($tableName);

        $table->removeIndexByName($usernameIndexName);
        $table->save();

        $this->query("CREATE UNIQUE INDEX {$usernameIndexName} ON users (LOWER(username))");
    }

    public function down(): void
    {
        $usernameIndexName = AddUsersTable::USERNAME_INDEX_NAME;
        $tableName = AddUsersTable::TABLE_NAME;

        $table = $this->table($tableName);

        $table->removeIndexByName($usernameIndexName);
        $table->save();

        $this->query("CREATE INDEX {$usernameIndexName} ON users (LOWER(username))");
    }
}
