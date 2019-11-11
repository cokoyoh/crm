<?php


namespace CRM\Leads;


use CRM\Models\Contact;
use CRM\Models\Lead;

trait LeadConfirmation
{
    private function getAssociatedLeadFromEmail(String $email)
    {
        $company = auth()->user()->company;

        if (is_null($company)) return null;

        return Lead::where('company_id', $company->id)
            ->where('email', $email)
            ->first();
    }

    private function getAssociatedContactFromEmail(String $email)
    {
        $company = auth()->user()->company;

        if (is_null($company)) return null;

        return Contact::where('company_id', $company->id)
            ->where('email', $email)
            ->first();
    }

    private function getLeadAssignee(Lead $lead = null)
    {
        if (is_null($lead)) {
            return null;
        }

        $leadAssignee = $lead->leadAssignee;

        $user = $leadAssignee ? $leadAssignee->user : null;

        return $user ? $user->name : null;
    }

    private function getContactAssignee(Contact $contact = null)
    {
        if (is_null($contact)) {
            return null;
        };

        $contactUser = $contact->contactUser;

        $user = $contactUser ? $contactUser->user : null;

        return $user ? $user->name : '';
    }

    private function getPreparedMessage($contactAssignee = null, $leadAssignee = null)
    {
        if ($contactAssignee) {
            return 'A contact under the same email exists in the system and is currently assigned to ' . $contactAssignee;
        }

        if ($leadAssignee) {
            return 'A lead under the same email exists in the system and is currently assigned to ' . $leadAssignee;
        }

        return null;
    }
}
