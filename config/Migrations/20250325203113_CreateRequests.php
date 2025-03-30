<?php

declare(strict_types=1);

use Migrations\BaseMigration;

class CreateRequests extends BaseMigration
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
        $table = $this->table('requests');
        $table
            ->addColumn('user_id', 'integer')
            ->addColumn('type', 'enum', ['values' => ['artist', 'album']])
            ->addColumn('data', 'text')
            ->addColumn('status', 'enum', [
                'values' => ['pending', 'approved', 'rejected'],
                'default' => 'pending'
            ])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('modified', 'datetime', [
                'default' => 'CURRENT_TIMESTAMP',
                'update' => 'CURRENT_TIMESTAMP'
            ])
            ->create();
    }
}
