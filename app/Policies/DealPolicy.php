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

    public function addNotes(User $user, Deal $deal)
    {
        $notes = $deal->notes;

        if (is_null($notes)) {
            return $this->belongsToUser($user, $deal);
        }

        return $this->belongsToUser($user, $deal) && $this->hasNotes($user, $deal);
    }

    private function belongsToUser(User $user, Deal $deal)
    {
        return $user->id == $deal->user_id;
    }

    private function hasNotes(User $user, Deal $deal)
    {
        return $deal
            ->notes()
            ->where('user_id', $user->id)
            ->first();
    }
}
