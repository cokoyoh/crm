<?php

namespace App\Policies;

use CRM\Models\LeadSource;
use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadSourcePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }

        return false;
    }

    public function manageLeadSource(User $user, LeadSource $leadSource)
    {
        return true;
    }
}
