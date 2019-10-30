<?php

namespace App\Http\Controllers;

use CRM\Models\Lead;
use CRM\Models\LeadAssignee;

class LeadsController extends Controller
{
    public function store()
    {
        \request()->validate([
            'email' => "required_if:phone_number,''|email|unique:leads",
            'country_code' => "required_if:email,''",
            'phone_number' => "required_if:email,''"
        ]);

        $names = processName(\request('name'));

        $attributes = \request()->except('_token', 'name');

        $attributes['first_name'] = $names[0];

        $attributes['last_name'] = $names[1];

        $lead = Lead::create($attributes);

        LeadAssignee::create([
            'lead_id' => $lead->id,
            'user_id' => auth()->id()
        ]);

        return redirect(route('dashboard.user', auth()->id()));
    }
}
