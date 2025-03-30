<?php

declare(strict_types=1);

use Migrations\BaseMigration;

class CreateFavorites extends BaseMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/migrations/4/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('favorites');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('favoritable_id', 'integer')
            ->addColumn('favoritable_type', 'enum', [
                'values' => ['artist', 'album'],
            ])
            ->addColumn('created', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
            ])
            ->addIndex(['user_id'])
            ->addIndex(['favoritable_id'])
            ->addIndex(['favoritable_type'])
            ->create();
    }
}
