<?php

namespace App\Http\Controllers;

use CRM\Models\Company;
use CRM\Models\User;
use CRM\Schedules\ScheduleRepository;
use CRM\Transformers\CompanyTransformer;
use CRM\Users\UserRepository;

class HomeController extends Controller
{
    protected $schedule;
    protected $companyTransformer;
    protected $userRepository;

    /**
     * DashboardController constructor.
     * @param ScheduleRepository $schedule
     * @param CompanyTransformer $companyTransformer
     * @param UserRepository $userRepository
     */
    public function __construct(
        ScheduleRepository $schedule,
        CompanyTransformer $companyTransformer,
        UserRepository $userRepository
    )
    {
        $this->schedule = $schedule;
        $this->companyTransformer = $companyTransformer;
        $this->userRepository = $userRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dealPercentageChange = $this->userRepository->dealPercentageChange();

        return view('home', [
            'assignedLeadsCount' => $this->userRepository->totalUserLeads(),
            'schedules' => $this->schedule->userSchedules(),
            'greeting' => $this->greeting(),
            'usersCount' => User::count(),
            'userDeals' => $this->userRepository->totalUserDeals(),
            'verifiedDeals' => $this->userRepository->totalVerifiedDeals(),
            'companiesCount' => Company::count(),
            'dealPercentageChange' => $dealPercentageChange,
            'company' => auth()->user()->company
        ]);
    }

    private function greeting()
    {
        $time = (int) now()->format('H');

        if ($time < 12) return 'Good Morning';

        if ($time >= 12 && $time < 16) return 'Good Afternoon';

        return 'Good Evening';
    }
}
