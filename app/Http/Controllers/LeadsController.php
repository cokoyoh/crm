<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use CRM\LeadAssignees\LeadAssigneeRepository;
use CRM\Leads\LeadRepository;
use CRM\Models\Lead;
use Symfony\Component\Console\Input\Input;

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
