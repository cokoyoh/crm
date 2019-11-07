<?php

namespace App\Http\Controllers;

use App\Events\Leads\LeadMarkedAsLost;
use App\Http\Requests\StoreLeadRequest;
use CRM\LeadAssignees\LeadAssigneeRepository;
use CRM\LeadNotes\LeadNotesRepository;
use CRM\Leads\LeadRepository;
use CRM\Models\Lead;
use Illuminate\Support\Facades\DB;

class LeadsController extends Controller
{
    protected $lead;
    protected $leadAssignee;
    protected $leadNotes;

    /**
     * LeadsController constructor.
     * @param LeadRepository $lead
     * @param LeadAssigneeRepository $leadAssignee
     * @param LeadNotesRepository $leadNotes
     */
    public function __construct(
        LeadRepository $lead,
        LeadAssigneeRepository $leadAssignee,
        LeadNotesRepository $leadNotes
    ) {
        $this->lead = $lead;
        $this->leadAssignee = $leadAssignee;
        $this->leadNotes = $leadNotes;
    }

    public function show(Lead $lead)
    {
        $this->authorize('manageLead', $lead);

        $interactions = $this->lead->getInteractions($lead);

        $notes = $this->leadNotes->getNotes($lead);

        return view('leads.show', [
            'lead' => $lead,
            'interactions' => $interactions,
            'notes' => $notes
        ]);
    }


    public function store(StoreLeadRequest $request)
    {
        $lead = $this->lead->create($request->all());

        $this->leadAssignee->store(auth()->user(), $lead);

        if ($request->wantsJson()) {
            return [
                'message' => 'Lead saved successfully',
                'link' => route('leads.show', $lead)
            ];
        }

        flash('Lead added successfully.', 'success');

        return redirect()->route('leads.show', $lead);
    }

    public function getLeads()
    {
        $searchString = request('query');

        return Lead::query()
            ->where('first_name', 'like', "%{$searchString}%")
            ->orWhere('last_name', 'like', "%{$searchString}%")
            ->get()
            ->map(function ($lead) use($searchString){
                return [
                    'id' => $lead->id,
                    'name' => $lead->name,
                ];
            })
            ->toArray();
    }

    public function lost(Lead $lead)
    {
        $this->authorize('markAsLost', $lead);

        DB::transaction(function () use ($lead){
            $previousLeadStage = $lead->leadClass->name;

            $lead->markAsLost();

            event(new LeadMarkedAsLost($lead, $previousLeadStage));

            flash('This lead has been marked as lost.', 'success');
        });

        return redirect()->route('leads.show', $lead);
    }
}
