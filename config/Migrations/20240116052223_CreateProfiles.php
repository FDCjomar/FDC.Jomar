<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateProfiles extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('profiles');
        $table
            ->addColumn('user_id', 'integer', ['null' => false])
            ->addColumn('gender', 'string', ['limit' => 10, 'null' => true])
            ->addColumn('birthdate', 'date', ['null' => true])
            ->addColumn('hobby', 'text', ['null' => true])
            ->addColumn('profile_image', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => false,
            ])
            ->create();
    }
}
