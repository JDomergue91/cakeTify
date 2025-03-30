<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Entity;
use Authorization\IdentityInterface;

/**
 * Entity policy
 */
class EntityPolicy
{
    /**
     * Check if $user can add Entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Entity $entity
     * @return bool
     */

    public function canIndex(IdentityInterface $user, $entity)
    {
        return true;
    }

    public function canAdd(IdentityInterface $user, Entity $entity) {}

    /**
     * Check if $user can edit Entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Entity $entity
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Entity $entity) {}

    /**
     * Check if $user can delete Entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Entity $entity
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Entity $entity) {}

    /**
     * Check if $user can view Entity
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Entity $entity
     * @return bool
     */
    public function canView(IdentityInterface $user, Entity $entity) {}
}
