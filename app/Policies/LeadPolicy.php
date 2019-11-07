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

    public function manageLead(User $user, Lead $lead)
    {
        return $lead->isAssigned($user);
    }

    public function addNotes(User $user, Lead $lead)
    {
        $notes = $lead->notes;

        if (is_null($notes)) {
            return $lead->isAssigned($user);
        }

        return $lead->isAssigned($user) && $this->hasNotes($user, $lead);
    }

    private function hasNotes(User $user, Lead $lead)
    {
        return $lead
            ->notes()
            ->where('user_id', $user->id)
            ->first();
    }

    public function markAsLost(User $user, Lead $lead)
    {
        return $this->isAssignedButNotConverted($user, $lead) && $this->isNotLost($lead);
    }

    public function convertLead(User $user, Lead $lead)
    {
        return $this->isAssignedButNotConverted($user, $lead);
    }

    public function destroy(User $user, Lead $lead)
    {
        return $this->isAssignedButNotConverted($user, $lead);
    }

    private function isAssignedButNotConverted(User $user, Lead $lead)
    {
        return $lead->isAssigned($user) && is_null($lead->contact);
    }

    private function isNotLost(Lead $lead, $slug = 'lost')
    {
        return $lead->leadClass->slug != $slug;
    }
}
