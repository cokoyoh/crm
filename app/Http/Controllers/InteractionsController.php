<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInteractionRequest;
use CRM\Models\Interaction;
use CRM\Models\Lead;

class InteractionsController extends ApiController
{
    public function store(StoreInteractionRequest $request, Lead $lead)
    {
        $lead->addInteraction($request->validated());

        $lead->markAsFollowedUp();

        if ($request->wantsJson()) {
            return $this->respondSuccess([
                'message' => 'Interaction added successfully',
                'link' => route('leads.show', $lead)
            ]);
        }

        return redirect()->route('leads.show', $lead);
    }

    public function destroy(Interaction $interaction)
    {
        $this->authorize('manageInteraction', $interaction);

        $interaction->delete();

        flash('Interaction has been deleted!', 'success');

        return redirect()->route('leads.show', $interaction->lead);
    }
}
