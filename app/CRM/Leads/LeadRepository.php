<?php


namespace CRM\Leads;


use CRM\Models\Lead;
use CRM\Models\User;
use CRM\RepositoryInterfaces\CreateInterface;

class LeadRepository implements CreateInterface
{
    protected $lead;

    /**
     * LeadRepository constructor.
     * @param Lead $lead
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    public function create(array $attributes)
    {
        $names = $this->processNames($attributes);

        $attributes['first_name'] = $names ? $names[0] : $attributes['first_name'];

        $attributes['last_name'] = $names ? $names[1] : $attributes['last_name'];

        $lead = $this->lead->create($attributes);

        $lead->markAsNotFollowedUp();

        return $lead;
    }

    private function processNames(array &$attributes)
    {
        if (in_array('name', array_keys($attributes))) {
            $names = processName($attributes['name']);

            unset($attributes['name']);

            return $names;
        }

        return null;
    }

    public function getInteractions(Lead $lead)
    {
        $this->lead = $lead;

        return $this->lead
            ->interactions()
            ->take(4)
            ->latest()
            ->get();
    }

    public function getUserLeads(User $user)
    {
        if ($user->isSuperAdmin()) {
            return Lead::latest()->paginate(8);
        }

        if ($user->isAdmin()) {
            return $user->company->leads()->paginate(8);
        }

        return $user->assignedLeads()->paginate(8);
    }
}
