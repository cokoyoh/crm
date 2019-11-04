<?php

namespace App\Http\Controllers;

use CRM\Models\Company;
use CRM\Models\User;
use CRM\Schedules\ScheduleRepository;

class DashboardController extends Controller
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


    public function superAdmin()
    {
        $this->authorize('manageCompany', new Company());

        $companies = Company::all();

        $latestCompanies = Company::latest()->take(2)->get();

        $latestUsers = User::latest()->take(5)->get();

        return view('dashboards.super_admin', [
            'companies' => $companies,
            'companiesCount' => $companies->count(),
            'usersCount' => User::count(),
            'dealsCount' => 0,
            'latestCompanies' => $latestCompanies,
            'latestUsers' => $latestUsers
        ]);
    }

    public function admin(User $user)
    {
        $companyUsers = $user->company->users;

        $latestUsers = $this->getLatestUsersFromCompany($user->company);

        return view('dashboards.admin', [
            'user' => $user,
            'companyUsers' => $companyUsers,
            'usersCount' => $companyUsers->count(),
            'latestUsersCount' => $latestUsers->count(),
            'latestUsers' => $latestUsers,
            'dealsCount' => 0
        ]);
    }

    public function user(User $user)
    {
        $userSchedules = $this->schedule->userSchedules();

        return view('dashboards.user', [
            'user' => $user,
            'leads' => $user->leads(),
            'schedules' => $userSchedules
        ]);
    }

    private function getLatestUsersFromCompany(Company $company)
    {
        return $company->users()
            ->where('created_at', '>=', now()->subWeek())
            ->where('created_at', '<=', now())
            ->latest()
            ->get();
    }
}
