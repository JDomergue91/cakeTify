<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AlbumsFixture
 */
class AlbumsFixture extends TestFixture
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
                'artist_id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'release_date' => '2025-03-24',
                'spotify_link' => 'Lorem ipsum dolor sit amet',
                'created' => '2025-03-24 13:42:39',
                'modified' => '2025-03-24 13:42:39',
            ],
        ];
        parent::init();
    }
}
