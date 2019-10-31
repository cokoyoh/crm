<?php


namespace CRM\Schedules;


use CRM\RepositoryInterfaces\CreateInterface;

class ScheduleRepository implements CreateInterface
{
    public function create(array $attributes)
    {
        return auth()->user()
            ->schedules()
            ->create($attributes);
    }
}
