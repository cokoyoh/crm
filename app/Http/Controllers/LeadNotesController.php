<?php

namespace App\Http\Controllers;

use CRM\Models\Lead;

class LeadNotesController extends Controller
{
    public function store(Lead $lead)
    {
        $this->authorize('manageLead', $lead);

        $lead->addNotes(\request('body'));

        flash('Notes added successfully.', 'success');

        return redirect()->route('leads.show', $lead);
    }
}
