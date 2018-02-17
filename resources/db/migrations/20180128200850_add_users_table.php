<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

class AddUsersTable extends AbstractMigration
{
    public const USERNAME_INDEX_NAME = 'user_username_lower';
    public const TABLE_NAME = 'users';

    /**
     * {@inheritdoc}
     */
    public function up(): void
    {
        $usernameIndexName = self::USERNAME_INDEX_NAME;
        $tableName = self::TABLE_NAME;

        $table = $this->table($tableName, ['id' => false, 'primary_key' => 'id']);

        $table->addColumn('id', 'uuid');
        $table->addColumn(
            'email',
            'string',
            ['limit' => 240, 'null' => false]
        );
        $table->addColumn(
            'password',
            'string',
            ['limit' => 240, 'null' => false]
        );
        $table->addColumn(
            'username',
            'string',
            ['limit' => 240, 'null' => false]
        );
        $table->addColumn(
            'created_at',
            'timestamp',
            ['limit' => 6, 'null' => false]
        );
        $table->addColumn(
            'updated_at',
            'timestamp',
            ['limit' => 6, 'null' => false]
        );
        $table->addColumn(
            'roles',
            'jsonb',
            ['null' => false]
        );
        $table->addColumn(
            'verified',
            'boolean',
            ['null' => false]
        );

        $table->addIndex('email', ['unique' => true]);

        $table->create();

        $this->query("CREATE INDEX {$usernameIndexName} ON {$tableName} (LOWER(username))");
    }

    public function down(): void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
