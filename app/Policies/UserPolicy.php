<?php

namespace App\Policies;

use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can complete the user.
     *
     * @param User|null $authenticatedUser
     * @param User $user
     * @return mixed
     */
    public function completeProfile(?User $authenticatedUser, User $user)
    {
        return ! $user->hasVerifiedEmail();
    }

    public function view(User $authenticatedUser, User $user)
    {
        return ($authenticatedUser->isAdmin() || $authenticatedUser->isSuperAdmin());
    }


    public function manageUsers(User $authenticatedUser)
    {
        return $authenticatedUser->isAdmin();
    }

    public function delete(User $authenticatedUser, User $user)
    {
        if ($authenticatedUser->isAdmin()
            && $this->isNotSelf($authenticatedUser, $user)
            && $this->sameCompany($authenticatedUser, $user)) {
            return true;
        }

        return false;
    }

    private function isNotSelf(User $authenticatedUser, User $user)
    {
        return ! ($authenticatedUser->id == $user->id);
    }

    private function sameCompany(User $authenticatedUser, User $user)
    {
        return $user->company_id == $authenticatedUser->company_id;
    }
}
