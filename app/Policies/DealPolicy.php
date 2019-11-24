<?php

namespace App\Policies;

use CRM\Models\Deal;
use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealPolicy
{
    use HandlesAuthorization;

    public function manageDeal(User $user, Deal $deal)
    {
        return $user->id == $deal->user_id;
    }
}
