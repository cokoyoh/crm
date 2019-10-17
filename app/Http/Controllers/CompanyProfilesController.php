<?php

namespace App\Http\Controllers;

use App\Events\Companies\CompanyProfileUpdated;
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
        $this->authorize('updateProfile', $company);

        return view('companies.profiles.complete', compact('company'));
    }

    public function store(Company $company)
    {
        $this->authorize('updateProfile', $company);

        request()->validate(['email' => 'email|required', 'password' => 'required|min:8']);

        $user = $this->user->create(request()->only('name', 'email', 'password'));

        $user->addRole('company_admin');

        $this->company->update($company->id, request()->only('company_name', 'company_email'));

        event(new CompanyProfileUpdated($user, $company->fresh()));

        return redirect(route('login'));
    }
}
