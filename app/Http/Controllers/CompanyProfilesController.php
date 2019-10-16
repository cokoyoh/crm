<?php

namespace App\Http\Controllers;

use CRM\Companies\CompanyRepository;
use CRM\Models\Company;
use CRM\Users\UserRepository;

class CompanyProfilesController extends Controller
{
    protected $company;
    protected $user;

    /**
     * CompanyProfilesController constructor.
     * @param UserRepository $user
     * @param CompanyRepository $company
     */
    public function __construct(UserRepository $user, CompanyRepository $company)
    {
        $this->company = $company;
        $this->user = $user;
    }


    public function complete(Company $company)
    {
        return view('companies.profiles.complete', compact('company'));
    }

    public function store($companyId)
    {
        $this->company->update($companyId, request()->only('company_name', 'company_email'));

        $this->user->create(request()->only('name', 'email', 'password'))->addRole('company_admin');

        return redirect(route('login'));
    }
}
