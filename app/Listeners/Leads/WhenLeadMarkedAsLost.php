<?php

namespace App\Listeners\Leads;

use App\Events\Leads\LeadMarkedAsLost;
use CRM\Models\Lead;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class WhenLeadMarkedAsLost
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
     * @param  LeadMarkedAsLost  $event
     * @return void
     */
    public function handle(LeadMarkedAsLost $event)
    {
        $lead = $event->lead;

        $user = auth()->user();

        $company = $user->company;

        if ($company) {
            sendMail([
                'to' => $company->admin->email,
                'firstname' => $company->admin->first_name,
                'cc' => $user->email,
                'bcc' => [$company->email],
                'subject' => config('app.name') . ' - Lead Lost Notification',
                'view' => 'emails.leads.lead_lost',
                'lead' => $lead,
                'assignee' => $lead->leadAssignee->user,
                'stage' => $event->previousStage
            ]);
        }
    }
}
