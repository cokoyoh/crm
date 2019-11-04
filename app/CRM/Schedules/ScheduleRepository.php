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

    public function getScheduleStatus(Schedule $schedule)
    {
        $date = $schedule->date . ' ' . $schedule->start_at;

        $date = Carbon::createFromFormat('Y-m-d H:i:s', $date);

        if ($date->copy()->isToday()) {
            $startTime = Carbon::parse($schedule->start_at);

            $endTime = Carbon::parse($schedule->end_at);

            if ($startTime->isCurrentHour() && $endTime->isFuture()) {
                return 'in_progress';
            } elseif($startTime->isPast()) {
                return 'completed';
            } else {
                return 'upcoming';
            }
        }

        if ($date->copy()->isFuture()) {
            return 'upcoming';
        }

        return 'completed';
    }
}
