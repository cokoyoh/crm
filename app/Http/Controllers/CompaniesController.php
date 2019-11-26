<?php

namespace App\Http\Controllers;

use App\Events\Companies\CompanyInvited;
use CRM\Companies\CompanyRepository;
use CRM\Models\Company;
use CRM\Users\UserRepository;

class CompaniesController extends Controller
{
    protected $companyRepository;
    protected $user;

    /**
     * CompaniesController constructor.
     * @param CompanyRepository $companyRepository
     * @param UserRepository $user
     */
    public function __construct(CompanyRepository $companyRepository, UserRepository $user)
    {
        $this->companyRepository = $companyRepository;
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

        $dealsTotal = $this->companyRepository->dealsTotal($company);

        $verifiedDeals = $this->companyRepository->verifiedDeals($company);

        return view('companies.show', [
            'company' => $company,
            'usersCount' => $company->users()->count(),
            'leadsCount' => $company->leads()->count(),
            'dealsTotal' => $dealsTotal,
            'verifiedDeals' => $verifiedDeals
        ]);
    }

    public function store()
    {
        $this->authorize('inviteCompany', Company::class);

        request()->validate(['email' => 'required|email']);

        $company = $this->companyRepository->create(request()->except('_token'));

        event(new CompanyInvited($company));

        flash('Company invited and email sent successfully', 'success');

        return redirect(route('companies.show', $company));
    }
}
