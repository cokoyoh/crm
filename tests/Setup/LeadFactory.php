<?php


namespace Tests\Setup;


use CRM\Models\Lead;
use CRM\Models\LeadAssignee;
use CRM\Models\User;

class LeadFactory
{
    public $user = null;

    public function create()
    {
        $lead = create(Lead::class);

        if (is_null($this->user)) return $lead;

        create(LeadAssignee::class, ['lead_id' => $lead->id, 'user_id' => $this->user->id]);

        return $lead;
    }

    public function assignTo(User $user = null)
    {
        $this->user = $user;

        return $this;
    }
}
