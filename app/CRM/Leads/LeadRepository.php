<?php


namespace CRM\Leads;


use CRM\Models\Lead;
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

        $attributes['last_name'] = $names ? $names[0] : $attributes['last_name'];

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
}
