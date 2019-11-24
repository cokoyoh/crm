<?php

namespace App\Http\Controllers;

use CRM\Models\Deal;

class DealNotesController extends Controller
{
    public function store(Deal $deal)
    {
        $this->authorize('addNotes', $deal);

        request()->validate(['user_id' => 'required']);

        $deal->addNotes(\request()->except('_token'));

        flash('Notes added successfully', 'success');

        return redirect()->route('deals.show', $deal);
    }
}
