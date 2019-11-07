<?php

namespace App\Events\Leads;

use CRM\Models\Lead;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeadMarkedAsLost
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $lead;
    public $previousStage;

    /**
     * Create a new event instance.
     *
     * @param Lead $lead
     * @param String $previousStage
     */
    public function __construct(Lead $lead, String $previousStage)
    {
        $this->lead = $lead;
        $this->previousStage = $previousStage;
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
