<?php

namespace App\Http\Controllers;

use App\Events\Companies\CompanyInvited;
use App\Events\Users\UserInvited;
use CRM\Companies\CompanyRepository;
use CRM\Models\Company;
use CRM\Users\UserRepository;

class CompaniesController extends Controller
{
    protected $company;
    protected $user;

    /**
     * CompaniesController constructor.
     * @param CompanyRepository $company
     * @param UserRepository $user
     */
    public function __construct(CompanyRepository $company, UserRepository $user)
    {
        $this->company = $company;
        $this->user = $user;
    }

    public function index()
    {
        //code here
    }

    public function create()
    {
        $this->authorize('inviteCompany', Company::class);

        return view('companies.create');
    }

    public function show(Company $company)
    {
        $this->authorize('manageCompany', $company);

        return view('companies.show', compact('company'));
    }

    public function store()
    {
        $this->authorize('inviteCompany', Company::class);

        request()->validate(['email' => 'required|email']);

        $company = $this->company->create(request()->except('_token'));

        event(new CompanyInvited($company));

        return redirect(route('companies.show', $company->id));
    }

    public function invites(Company $company)
    {
        $this->authorize('manageCompany', $company);

        request()->validate(['name' => 'required', 'email' => 'required|email|unique:users,email']);

        $user = $this->user->invite($company, request()->except('_token'));

        event(new UserInvited($user));

        return redirect(route('companies.show', $company));
    }
}
