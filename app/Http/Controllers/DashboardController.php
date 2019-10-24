<?php

namespace App\Http\Controllers;

use CRM\Models\Company;

class DashboardController extends Controller
{
    public function superAdmin()
    {
        $this->authorize('manageCompany', new Company());

        $companies = Company::all();

        return view('dashboards.super_admin', compact('companies'));
    }
}
