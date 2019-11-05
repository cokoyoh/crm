<?php


namespace Tests\Setup;


use CRM\Models\Lead;
use CRM\Models\LeadAssignee;
use CRM\Models\LeadClass;
use CRM\Models\User;

class LeadFactory
{
    public $user = null;

    public $leadClass = null;

    public function create()
    {
        $leadClassId = $this->leadClass ? LeadClass::first()->id : null;

        $lead = create(Lead::class, ['lead_class_id' => $leadClassId]);

        if (is_null($this->user)) return $lead;

        create(LeadAssignee::class, ['lead_id' => $lead->id, 'user_id' => $this->user->id]);

        return $lead;
    }

    public function assignTo(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    public function withClass(String $leadClassSlug = null)
    {
        $this->leadClass = $leadClassSlug ?? $this->leadClass;

        create(LeadClass::class, ['slug' => $this->leadClass]);

        return $this;
    }
}
