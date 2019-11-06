<?php

namespace App\Http\Controllers;

use CRM\Models\Lead;

class LeadNotesController extends Controller
{
    public function store(Lead $lead)
    {
        $this->authorize('manageLead', $lead);

        request()->validate(['user_id' => 'required']);

        $lead->addNotes(request()->except('_token'));

        flash('Notes added successfully.', 'success');

        return redirect()->route('leads.show', $lead);
    }
}
