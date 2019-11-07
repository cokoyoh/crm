<?php


namespace Tests\Setup;


use CRM\Models\Interaction;
use CRM\Models\Lead;
use CRM\Models\User;

class InteractionFactory
{
    public $user = null;
    public $lead = null;

    public function create()
    {
        $lead = $this->lead ?? create(Lead::class);

        return create(Interaction::class, [
            'lead_id' => $lead->id,
            'user_id' => optional($this->user)->id
        ]);
    }

    public function belongingTo($user)
    {
        $this->user = $user ?? create(User::class);

        return $this;
    }

    public function fromLead($lead)
    {
        $this->lead = $lead;

        return $this;
    }
}
