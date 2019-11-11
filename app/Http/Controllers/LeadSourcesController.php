<?php

namespace App\Http\Controllers;

use CRM\Models\LeadSource;

class LeadSourcesController extends Controller
{
    public function store()
    {
        $this->authorize('manageLeadSource', new LeadSource());

        LeadSource::create(request()->all());

        return redirect()->route('dashboard.user', auth()->user());
    }
}
