<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Apis\ApiController;
use CRM\Models\LeadSource;

class LeadSourcesController extends ApiController
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

        if (request()->wantsJson()) {
            return $this->respondSuccess([
                'message' => 'Lead source added successfully.'
            ]);
        }

        return redirect()->route('dashboard.user', auth()->user());
    }
}
