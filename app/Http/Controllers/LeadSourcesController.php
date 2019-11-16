<?php

namespace App\Http\Controllers;

use CRM\Models\LeadSource;

class LeadSourcesController extends Controller
{
    public function index()
    {
        $company = auth()->user()->company;

        $this->authorize('manageCompany', $company);

        return view('leadsources.index', [
            'company' => $company
        ]);
    }


    public function store()
    {
        $this->authorize('manageLeadSource', new LeadSource());

        request()->validate(['name' => 'required|min:8']);

        LeadSource::create(request()->all());

        return redirect()->route('dashboard.user', auth()->user());
    }
}
