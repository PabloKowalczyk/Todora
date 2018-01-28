<?php

declare(strict_types=1);
use Phinx\Migration\AbstractMigration;

class AddUsersTable extends AbstractMigration
{
    private const USERNAME_INDEX_NAME = 'user_username_lower';
    private const TABLE_NAME = 'users';

    /**
     * {@inheritdoc}
     */
    public function up(): void
    {
        $usernameIndexName = self::USERNAME_INDEX_NAME;

        $table = $this->table(self::TABLE_NAME, ['id' => false, 'primary_key' => 'id']);

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

        $this->query("CREATE INDEX {$usernameIndexName} ON users (LOWER(username))");
    }

    public function down(): void
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
