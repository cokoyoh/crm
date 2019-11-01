<?php


namespace CRM\Schedules;


use Carbon\Carbon;
use CRM\Models\Schedule;
use CRM\Models\User;
use CRM\RepositoryInterfaces\CreateInterface;
use Illuminate\Database\Eloquent\Collection;

class ScheduleRepository implements CreateInterface
{
    public function create(array $attributes)
    {
        return auth()->user()
            ->schedules()
            ->create($attributes);
    }

    public function userSchedules(User $user = null)
    {
        $user = $user ?? auth()->user();

        $schedules = $this->fetchUserLeads($user);

        return $this->displaySchedules($schedules);
    }

    private function fetchUserLeads(User $user)
    {
        return $user
            ->schedules()
            ->latest()
            ->take(5) //temporary, should be removed
            ->get();
    }

    private function displaySchedules(Collection $schedules)
    {
        return $schedules
            ->map(function ($schedule) {
                return [
                    'status' => $this->getScheduleStatus($schedule),
                    'date' => Carbon::parse($schedule->date)->toDateString(),
                    'startAt' => Carbon::parse($schedule->start_at)->format('g:i a'),
                    'endAt' => Carbon::parse($schedule->end_at)->format('g:i a'),
                    'leadName' => $schedule->lead->name
                ];
            });
    }

    private function getScheduleStatus(Schedule $schedule)
    {
        $date = Carbon::parse($schedule->date);

        if ($date->copy()->isPast()) {
            return 'completed';
        }

        $startAt = Carbon::parse($schedule->start_at);

        $endAt = Carbon::parse($schedule->end_at);

        if ($startAt->copy()->isCurrentHour() && $endAt < now()->addHours(2)   &&  Carbon::parse($schedule->date)->isToday()) {
            return 'in_progress';
        }

        if ($date->copy() > today()->endOfDay()) {
            return 'up_coming';
        }

        return 'un_known_time';
    }
}
