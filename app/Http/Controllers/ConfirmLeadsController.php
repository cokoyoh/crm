<?php

namespace App\Http\Controllers;

use CRM\Leads\LeadConfirmation;

class ConfirmLeadsController extends ApiController
{
    use LeadConfirmation;

    public function email()
    {
        $lead = $this->getAssociatedLeadFromEmail(
            \request()->query('email')
        );

        $leadAssignee = $this->getLeadAssignee($lead);

        $message = $leadAssignee
            ? 'A lead under the same email exists in the system and is currently assigned to '. $leadAssignee
            : null;

        return $this->respondSuccess([
            'message' => $message
        ]);
    }
}
