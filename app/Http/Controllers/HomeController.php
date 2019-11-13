<?php

namespace App\Http\Controllers;

use CRM\Models\Company;
use CRM\Models\User;
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

        $companies = Company::all();

        $latestCompanies = Company::latest()->take(2)->get();

        $latestUsers = User::latest()->take(5)->get();

        return view('home', [
            'leads' => auth()->user()->leads(),
            'schedules' => $userSchedules,
            'greeting' => $this->greeting(),
            'companies' => $companies,
            'companiesCount' => $companies->count(),
            'usersCount' => User::count(),
            'dealsCount' => 0,
            'latestCompanies' => $latestCompanies,
            'latestUsers' => $latestUsers
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
