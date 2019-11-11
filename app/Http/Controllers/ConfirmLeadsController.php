<?php

namespace App\Http\Controllers;

use CRM\Models\Lead;

class ConfirmLeadsController extends ApiController
{
    public function email()
    {
        $lead = $this->getAssociatedLeadFromEmail(
            \request()->query('email')
        );

        $leadAssignee = $this->getLeadAssignee($lead);

        $message = $leadAssignee ? 'A lead under the same email exists in the system and is currently assigned to '. $leadAssignee : null;

        return $this->respondSuccess([
            'message' => $message
        ]);
    }

    private function getAssociatedLeadFromEmail(String $email)
    {
        //the lead should be considered only among the users from the same company
        return Lead::where('email', $email)->first();
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
