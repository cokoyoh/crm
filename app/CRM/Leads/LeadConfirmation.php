<?php


namespace CRM\Leads;


use CRM\Models\Lead;

trait LeadConfirmation
{
    private function getAssociatedLeadFromEmail(String $email)
    {
        return Lead::whereHas('leadAssignee', function ($leadAssignee) {
            $leadAssignee->whereHas('user', function ($user) {
                $user->where('company_id', auth()->user()->company->id);
            });
        })
            ->where('email', $email)
            ->first();
    }

    private function getLeadAssignee(Lead $lead = null)
    {
        if (is_null($lead)) {
            return null;
        }

        $leadAssignee = $lead->leadAssignee;

        if ($leadAssignee) {
            return optional($leadAssignee->user)->name;
        }

        return null;
    }
}
