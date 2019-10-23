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
     * @param \CRM\Models\User $user
     * @param User $model
     * @return mixed
     */
    public function completeProfile(?User $user, User $model)
    {
        return ! $model->hasVerifiedEmail();
    }

    public function delete(User $user, User $model)
    {
        if ($user->hasRole('admin') && $this->sameCompany($user, $model)) {
            return true;
        }

        return false;
    }

    private function sameCompany(User $user, User $model)
    {
        return $model->company_id === $user->company_id;
    }
}
