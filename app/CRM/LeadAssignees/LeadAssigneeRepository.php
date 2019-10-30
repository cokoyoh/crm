<?php


namespace CRM\LeadAssignees;


use CRM\Models\Lead;
use CRM\Models\LeadAssignee;
use CRM\Models\User;

class LeadAssigneeRepository
{
    protected $leadAssignee;

    /**
     * LeadAssigneeRepository constructor.
     * @param $leadAssignee
     */
    public function __construct(LeadAssignee $leadAssignee)
    {
        $this->leadAssignee = $leadAssignee;
    }

    public function store(User $user, Lead $lead)
    {
        return $this->leadAssignee->create([
            'user_id' => $user->id,
            'lead_id' => $lead->id
        ]);
    }
}
