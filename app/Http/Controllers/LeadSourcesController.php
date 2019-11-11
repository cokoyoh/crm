<?php

namespace App\Http\Controllers;

use CRM\Models\LeadSource;

class LeadSourcesController extends Controller
{
    public function store()
    {
        $this->authorize('manageLeadSource', new LeadSource());

        request()->validate(['name' => 'required|min:8']);

        LeadSource::create(request()->all());

        return redirect()->route('dashboard.user', auth()->user());
    }
}
