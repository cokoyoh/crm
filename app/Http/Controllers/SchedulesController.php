<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;
use CRM\Models\Schedule;
use CRM\Schedules\ScheduleRepository;

class SchedulesController extends ApiController
{
    protected $schedule;

    /**
     * SchedulesController constructor.
     * @param $schedule
     */
    public function __construct(ScheduleRepository $schedule)
    {
        $this->schedule = $schedule;
    }


    public function store(StoreScheduleRequest $request)
    {
        $this->schedule->create($request->validated());

        if ($request->wantsJson()) {
            return $this->respondSuccess([
                    'message' => 'Schedule added successfully',
                    'link' => route('dashboard.user', auth()->user())
                ]);
        }

        return redirect(route('dashboard.user', auth()->user()));
    }


    public function destroy(Schedule $schedule)
    {
        $this->authorize('destroy', $schedule);

        $this->schedule->destroy($schedule);

        flash()->success('Schedule deleted!');

        return back();
    }
}
