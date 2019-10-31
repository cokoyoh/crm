<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScheduleRequest;

class SchedulesController extends Controller
{
    public function store(StoreScheduleRequest $request)
    {
        auth()->user()->schedules()->create($request->validated());

        return redirect(route('dashboard.user', auth()->user()));
    }
}
