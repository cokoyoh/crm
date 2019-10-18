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
        return $model->hasVerifiedEmail();
    }
}
