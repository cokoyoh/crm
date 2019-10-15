<?php

namespace App\Http\Controllers;

use App\Events\Companies\CompanyInvited;
use CRM\Models\Company;

class CompaniesController extends Controller
{
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

        $validated = request()->validate([
            'email' => 'email | required'
        ]);

        $validated['name'] = \request('name');

        $company =  Company::create(\request()->except('_token'));

        event(new CompanyInvited($company));

        return redirect(route('companies.show', $company->id));
    }
}
