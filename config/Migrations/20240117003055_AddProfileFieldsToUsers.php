<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class AddProfileFieldsToUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('gender', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'password'
        ]);
        $table->addColumn('birthdate', 'date', [
            'default' => null,
            'null' => true,
            'after' => 'gender'
        ]);
        $table->addColumn('hobby', 'text', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'birthdate'
        ]);
        $table->addColumn('profile_img', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => true,
            'after' => 'hobby'
        ]);
        $table->update();
    }
}
