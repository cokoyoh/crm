<?php

namespace App\Policies;

use CRM\Models\Interaction;
use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InteractionPolicy
{
    use HandlesAuthorization;

    public function manageInteraction(User $user, Interaction $interaction)
    {
        return $user->id == $interaction->user_id;
    }
}
