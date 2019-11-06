<?php


namespace Tests\Setup;


use CRM\Models\Interaction;
use CRM\Models\Lead;
use CRM\Models\User;

class InteractionFactory
{
    public $user = null;

    public function create()
    {
        $lead = create(Lead::class);

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
}
