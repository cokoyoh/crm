<?php

namespace App\Policies;

use CRM\Models\Lead;
use CRM\Models\LeadSource;
use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadSourcePolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->isAdmin();
    }

    public function manageLeadSource(User $user, LeadSource $leadSource)
    {
        return true;
    }

    public function destroy(User $user, LeadSource $leadSource)
    {
        return $user->isAdmin()
            && $this->isSameCompany($user, $leadSource)
            && $this->doesntHaveLeads($leadSource);
    }

    private function isSameCompany(User $user, LeadSource $leadSource)
    {
        return $user->company_id == $leadSource->company_id;
    }

    private function doesntHaveLeads(LeadSource $leadSource)
    {
        return ! $leadSource->leads()->exists();
    }
}
