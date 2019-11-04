<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInteractionRequest;
use CRM\Models\Lead;

class InteractionsController extends Controller
{
    public function store(StoreInteractionRequest $request, Lead $lead)
    {
        $lead->addInteraction($request->validated());

        return redirect()->route('leads.show', $lead);
    }
}
