<?php

namespace App\Policies;

use CRM\Models\Lead;
use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can create interactions.
     *
     * @param User $user
     * @param Lead $lead
     * @return mixed
     */
    public function addInteraction(User $user, Lead $lead)
    {
        return $lead->isAssigned($user);
    }
}
