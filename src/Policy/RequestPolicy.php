<?php
namespace App\Policy;

use App\Model\Entity\Request;
use Authorization\IdentityInterface;

class RequestPolicy
{
    // Admins can do everything
    public function canIndex(IdentityInterface $user, Request $request)
    {
        return $user->role === 'user';
    }

    public function canView(IdentityInterface $user, Request $request)
    {
        return $user-> id === $request->user_id || $user->role === 'admin';
    }

    public function canAdd(IdentityInterface $user, Request $request)
    {
        return $user->role === 'user';
    }

    public function canEdit(IdentityInterface $user, Request $request)
    {
        return $user->role === 'admin';
    }

    public function canDelete(IdentityInterface $user, Request $request)
    {
        return $user->role === 'admin';
    }

    public function canApprove(IdentityInterface $user, Request $request)
    {
        return $user->role === 'admin';
    }

    public function canReject(IdentityInterface $user, Request $request)
    {
        return $user->role === 'admin';
    }

    public function canRequestArtist(IdentityInterface $user, Request $request)
    {
        return $user->role === 'user';
    }

    public function canRequestAlbum(IdentityInterface $user, Request $request)
    {
        return $user->role === 'user';
    }
}
