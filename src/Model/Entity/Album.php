<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Album Entity
 *
 * @property int $id
 * @property int $artist_id
 * @property string $title
 * @property \Cake\I18n\Date|null $release_date
 * @property string|null $spotify_link
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Artist $artist
 */
class Album extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'artist_id' => true,
        'title' => true,
        'release_date' => true,
        'spotify_link' => true,
        'created' => true,
        'modified' => true,
        'artist' => true,
    ];
}
