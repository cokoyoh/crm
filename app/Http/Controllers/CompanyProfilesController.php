<?php

namespace App\Http\Controllers;

use CRM\Companies\CompanyProfilesRepository;
use CRM\Models\Company;

class CompanyProfilesController extends Controller
{
    protected $company;

    /**
     * CompanyProfilesController constructor.
     * @param CompanyProfilesRepository $company
     */
    public function __construct(CompanyProfilesRepository $company)
    {
        $this->company = $company;
    }


    public function complete(Company $company)
    {
        $this->authorize('updateProfile', $company);

        return view('companies.profiles.complete', compact('company'));
    }

    public function store(Company $company)
    {
        $this->authorize('updateProfile', $company);

        request()->validate(['email' => 'email|required', 'password' => 'required|min:8']);

        $this->company->updateProfile($company, request()->except('_token'));

        return redirect(route('login'));
    }
}
