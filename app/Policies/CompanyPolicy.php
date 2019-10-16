<?php

namespace App\Policies;

use CRM\Models\Company;
use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create companies.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isSuperAdmin();
    }

    public function updateProfile(?User $user, Company $company)
    {
        return is_null($company->confirmed_at);
    }
}
