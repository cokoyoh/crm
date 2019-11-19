<?php

namespace App\Listeners\Leads;

use App\Events\Leads\LeadReassigned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WhenLeadReassigned
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LeadReassigned  $event
     * @return void
     */
    public function handle(LeadReassigned $event)
    {
        $lead = $event->lead;

        $currentAssignee = $event->currentAssignee;

        $previousAssignee = $event->previousAssignee;

        $this->notifyPreviousAssignee($lead, $currentAssignee, $previousAssignee);

        $this->notifyCurrentAssignee($lead, $currentAssignee, $previousAssignee);
    }

    private function notifyPreviousAssignee($lead, $currentAssignee, $previousAssignee)
    {
        if (is_null($previousAssignee)) return;

        $admin = auth()->user();

        sendMail([
            'to' => $previousAssignee->email,
            'view' => 'emails.leads.assignments.notify_previous_lead_owner',
            'subject' => config('app.name') . ' - Lead Reassigned',
            'firstname' => $previousAssignee->first_name,
            'cc' => $admin->email,
            'bcc' => [optional($admin->company)->email],
            'lead' => $lead,
            'admin' => $admin,
            'currentAssignee' => $currentAssignee
        ]);
    }

    private function notifyCurrentAssignee($lead, $currentAssignee, $previousAssignee)
    {
        if (is_null($currentAssignee)) return;

        $admin = auth()->user();

        sendMail([
            'to' => $currentAssignee->email,
            'view' => 'emails.leads.assignments.notify_current_lead_owner',
            'subject' => config('app.name') . ' - Lead Assignment Notification',
            'firstname' => $currentAssignee->first_name,
            'cc' => $admin->email,
            'bcc' => [optional($admin->company)->email],
            'lead' => $lead,
            'admin' => $admin,
            'previousAssignee' => $previousAssignee
        ]);
    }
}
