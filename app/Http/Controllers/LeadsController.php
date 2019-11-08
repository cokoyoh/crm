<?php

namespace App\Http\Controllers;

use App\Events\Leads\LeadMarkedAsLost;
use App\Http\Requests\StoreLeadRequest;
use CRM\LeadAssignees\LeadAssigneeRepository;
use CRM\LeadNotes\LeadNotesRepository;
use CRM\Leads\LeadRepository;
use CRM\Models\Lead;
use CRM\Transformers\LeadsTransformer;
use Illuminate\Support\Facades\DB;

class LeadsController extends ApiController
{
    protected $lead;
    protected $leadAssignee;
    protected $leadNotes;
    protected $leadsTransformer;

    /**
     * LeadsController constructor.
     * @param LeadRepository $lead
     * @param LeadAssigneeRepository $leadAssignee
     * @param LeadNotesRepository $leadNotes
     * @param LeadsTransformer $leadsTransformer
     */
    public function __construct(
        LeadRepository $lead,
        LeadAssigneeRepository $leadAssignee,
        LeadNotesRepository $leadNotes,
        LeadsTransformer $leadsTransformer
    ) {
        $this->lead = $lead;
        $this->leadAssignee = $leadAssignee;
        $this->leadNotes = $leadNotes;
        $this->leadsTransformer = $leadsTransformer;
    }

    public function create(Lead $lead = null)
    {
        if ($lead)
            $this->authorize('manageLead', $lead);

        return view('leads.create', [
            'lead' => $lead
        ]);
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
            return $this->respondSuccess([
                'message' => 'Lead saved successfully',
                'link' => route('leads.show', $lead)
            ]);
        }

        flash('Lead added successfully.', 'success');

        return redirect()->route('leads.show', $lead);
    }

    public function getLeads()
    {
        $searchString = request('query');

        $leads = Lead::query()
            ->where('first_name', 'like', "%{$searchString}%")
            ->orWhere('last_name', 'like', "%{$searchString}%")
            ->get();

        return $this->leadsTransformer->transformCollection($leads);
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

    public function convert(Lead $lead)
    {
        $this->authorize('convertLead', $lead);

        DB::transaction(function () use ($lead){
            $lead->convert();

            $lead->markAsConverted();

            flash('Lead converted successfully', 'success');
        });

        return redirect()->route('leads.show', $lead);
    }

    public function destroy(Lead $lead)
    {
        $this->authorize('destroy', $lead);

        DB::transaction(function () use ($lead) {
            $lead->expunge();

            flash('Lead deleted successfully', 'success');
        });

        return redirect()->route('dashboard.user', auth()->id());
    }
}
