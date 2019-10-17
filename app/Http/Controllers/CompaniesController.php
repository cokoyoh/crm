<?php

namespace App\Http\Controllers;

use App\Events\Companies\CompanyInvited;
use CRM\Companies\CompanyRepository;
use CRM\Models\Company;

class CompaniesController extends Controller
{
    protected $company;

    /**
     * CompaniesController constructor.
     * @param CompanyRepository $company
     */
    public function __construct(CompanyRepository $company)
    {
        $this->company = $company;
    }

    public function index()
    {
        //code here
    }

    public function create()
    {
        $this->authorize('create', Company::class);

        return view('companies.create');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function store()
    {
        $this->authorize('create', Company::class);

        request()->validate(['email' => 'required|email']);

        $company = $this->company->create(request()->except('_token'));

        event(new CompanyInvited($company));

        return redirect(route('companies.show', $company->id));
    }
}
