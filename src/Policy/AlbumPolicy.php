<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Album;
use Authorization\IdentityInterface;

/**
 * Album policy
 */
class AlbumPolicy
{
    /**
     * Check if $user can add Album
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Album $album
     * @return bool
     */

    public function canIndex(IdentityInterface $user, Album $album)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, Album $album) {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can edit Album
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Album $album
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Album $album) {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can delete Album
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Album $album
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Album $album) {
        return $user->role === 'admin';
    }

    /**
     * Check if $user can view Album
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Album $album
     * @return bool
     */
    public function canView(IdentityInterface $user, Album $album) {
        return true;
    }
}
