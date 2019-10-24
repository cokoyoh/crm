<?php

namespace App\Http\Controllers;

use CRM\Models\Company;
use CRM\Models\User;

class DashboardController extends Controller
{
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
}
