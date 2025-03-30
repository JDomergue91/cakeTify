<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Artist;
use Authorization\IdentityInterface;

/**
 * Artist policy
 */
class ArtistPolicy
{
    /**
     * Check if $user can add Artist
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Artist $artist
     * @return bool
     */
    public function canIndex(IdentityInterface $user, Artist $artist)
    {
        return true; // tout le monde peut voir
    }

    public function canView(IdentityInterface $user, Artist $artist)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, Artist $artist)
    {
        return $user->role === 'admin';
    }

    public function canEdit(IdentityInterface $user, Artist $artist)
    {
        return $user->role === 'admin';
    }

    public function canDelete(IdentityInterface $user, Artist $artist)
    {
        return $user->role === 'admin';
    }
}
