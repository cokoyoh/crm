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
            ->latest()
            ->paginate(4);
    }

    public function getUserLeads(User $user = null)
    {
        $user = $user ?? auth()->user();

        if ($user->isSuperAdmin()) {
            return Lead::latest()->paginate(8);
        }

        if ($user->isAdmin()) {
            return $user->company->leads()->latest()->paginate(8);
        }

        return $this->userLeads($user)->paginate(8);
    }

    public function assigned()
    {
        return  $this->userLeads()->paginate(8);
    }

    public function converted()
    {
        return $this->userLeads()->converted()->paginate(8);
    }

    public function lost()
    {
        return $this->userLeads()->lost()->paginate(8);
    }

    private function userLeads(User $user = null)
    {
        $user = $user ?? auth()->user();

        return $user->assignedLeads()->latest();
    }
}
