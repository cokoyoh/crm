<?php

namespace App\Policies;

use CRM\Models\Schedule;
use CRM\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
{
    use HandlesAuthorization;

    public function destroy(User $user, Schedule $schedule)
    {
        return $schedule->user_id == $user->id;
    }
}
