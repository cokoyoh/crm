<?php

namespace App\Http\Controllers;

use CRM\Leads\LeadConfirmation;

class ConfirmLeadsController extends ApiController
{
    use LeadConfirmation;

    public function email()
    {
        $email = request()->query('email');

        $lead = $this->getAssociatedLeadFromEmail($email);

        $contact = $this->getAssociatedContactFromEmail($email);

        $message = $this->getPreparedMessage(
            $this->getContactAssignee($contact),
            $this->getLeadAssignee($lead)
        );

        return $this->respondSuccess([
            'message' => $message
        ]);
    }
}
