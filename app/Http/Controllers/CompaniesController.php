<?php

namespace App\Http\Controllers;

use App\Events\Companies\CompanyInvited;
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
        $this->authorize('inviteCompany', Company::class);

        return view('companies.index');
    }

    public function create()
    {
        $this->authorize('inviteCompany', Company::class);

        return view('companies.create');
    }

    public function show(Company $company)
    {
        $this->authorize('manageCompany', $company);

        $usersCount = 0;

        $leadsCount = 0;

        return view('companies.show', [
            'company' => $company,
            'usersCount' => $usersCount,
            'leadsCount' => $company->leads()->count()
        ]);
    }

    public function store()
    {
        $this->authorize('inviteCompany', Company::class);

        request()->validate(['email' => 'required|email']);

        $company = $this->company->create(request()->except('_token'));

        event(new CompanyInvited($company));

        flash('Company invited and email sent successfully', 'success');

        return redirect(route('companies.show', $company));
    }
}
