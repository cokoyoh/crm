<?php

namespace App\Http\Controllers;

use CRM\Models\Lead;

class InteractionsController extends Controller
{
    public function store(Lead $lead)
    {
        $this->authorize('addInteraction', $lead);

        $validatedInput = request()->validate([
            'body' => 'required',
            'user_id' => 'required'
        ]);

        $lead->addInteraction($validatedInput);

        return redirect()->route('leads.show', $lead);
    }
}
