<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use CRM\LeadAssignees\LeadAssigneeRepository;
use CRM\Leads\LeadRepository;

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


    public function store(StoreLeadRequest $request)
    {
        $lead = $this->lead->create($request->all());

        $this->leadAssignee->store(auth()->user(), $lead);

        if ($request->wantsJson()) {
            return [
                'message' => 'Lead saved successfully',
                'link' => route('dashboard.user', auth()->id())
            ];
        }

        return redirect(route('dashboard.user', auth()->id()));
    }
}
