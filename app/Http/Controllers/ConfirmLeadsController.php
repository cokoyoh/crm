<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Apis\ApiController;
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
            'email',
            $this->getContactAssignee($contact),
            $this->getLeadAssignee($lead)
        );

        return $this->respondSuccess([
            'message' => $message
        ]);
    }

    public function phone()
    {
        $phone = request()->query('phone');

        $lead = $this->getAssociatedLeadFromPhone($phone);

        $contact = $this->getAssociatedContactFromPhone($phone);

        $message = $this->getPreparedMessage(
            'phone',
            $this->getContactAssignee($contact),
            $this->getLeadAssignee($lead)
        );

        return $this->respondSuccess([
            'message' => $message
        ]);
    }
}
