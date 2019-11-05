<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use CRM\LeadAssignees\LeadAssigneeRepository;
use CRM\Leads\LeadRepository;
use CRM\Models\Lead;

class LeadsController extends Controller
{
    protected $lead;
    protected $leadAssignee;

    /**
     * LeadsController constructor.
     * @param LeadRepository $lead
     * @param LeadAssigneeRepository $leadAssignee
     */
    public function __construct(
        LeadRepository $lead,
        LeadAssigneeRepository $leadAssignee
    ) {
        $this->lead = $lead;
        $this->leadAssignee = $leadAssignee;
    }

    public function show(Lead $lead)
    {
        $this->authorize('manageLead', $lead);

        $interactions = $this->lead->getInteractions($lead);

        return view('leads.show', [
            'lead' => $lead,
            'interactions' => $interactions
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
}
