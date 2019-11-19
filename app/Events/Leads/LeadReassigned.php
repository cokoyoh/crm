<?php

namespace App\Events\Leads;

use CRM\Models\Lead;
use CRM\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeadReassigned
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lead;
    public $currentAssignee;
    public $previousAssignee;

    /**
     * Create a new event instance.
     *
     * @param Lead $lead
     * @param User $currentAssignee
     * @param User $previousAssignee
     */
    public function __construct(
        Lead $lead,
        User $currentAssignee,
        User $previousAssignee
    ) {
        $this->lead = $lead;
        $this->currentAssignee = $currentAssignee;
        $this->previousAssignee = $previousAssignee;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
