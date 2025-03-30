<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FavoritesFixture
 */
class FavoritesFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'favoritable_id' => 1,
                'favoritable_type' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-03-24 13:42:40',
            ],
        ];
        parent::init();
    }
}
