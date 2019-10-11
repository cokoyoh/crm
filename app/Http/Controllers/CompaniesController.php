<?php

namespace App\Http\Controllers;

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

    public function store()
    {
        $this->authorize('create', Company::class);

        $validated = request()->validate([
            'email' => 'email | required'
        ]);

        $validated['name'] = \request('name');

        Company::create(\request()->except('_token'));

        return redirect(route('companies.index'));
    }
}
