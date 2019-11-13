<?php

namespace App\Http\Controllers;

use CRM\Schedules\ScheduleRepository;

class HomeController extends Controller
{
    protected $schedule;

    /**
     * DashboardController constructor.
     * @param $schedule
     */
    public function __construct(ScheduleRepository $schedule)
    {
        $this->schedule = $schedule;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userSchedules = $this->schedule->userSchedules();

        return view('home', [
            'leads' => auth()->user()->leads(),
            'schedules' => $userSchedules,
            'greeting' => $this->greeting()
        ]);
    }

    private function greeting()
    {
        $time = (int) now()->format('H');

        if ($time < 12) return 'Good Morning';

        if ($time > 12 && $time < 16) return 'Good Afternoon';

        return 'Good Evening';
    }
}
