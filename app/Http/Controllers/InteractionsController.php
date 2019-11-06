<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInteractionRequest;
use CRM\Models\Lead;

class InteractionsController extends Controller
{
    public function store(StoreInteractionRequest $request, Lead $lead)
    {
        $lead->addInteraction($request->validated());

        $lead->markAsFollowedUp();

        if ($request->wantsJson()) {
            return [
                'message' => 'Interaction added successfully',
                'link' => route('leads.show', $lead)
            ];
        }

        return redirect()->route('leads.show', $lead);
    }
}
