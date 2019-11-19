<?php

namespace App\Http\Controllers;

use App\Events\Leads\LeadMarkedAsLost;
use App\Http\Controllers\Apis\ApiController;
use App\Http\Requests\StoreLeadRequest;
use CRM\LeadAssignees\LeadAssigneeRepository;
use CRM\LeadNotes\LeadNotesRepository;
use CRM\Leads\LeadRepository;
use CRM\Models\Gender;
use CRM\Models\Lead;
use CRM\Transformers\GenderTransformer;
use CRM\Transformers\LeadSourceTransformer;
use CRM\Transformers\LeadsTransformer;
use CRM\Users\UserRepository;
use Illuminate\Support\Facades\DB;

class LeadsController extends ApiController
{
    protected $lead;
    protected $leadAssignee;
    protected $leadNotes;
    protected $leadsTransformer;
    protected $leadSourceTransformer;
    protected $genderTransformer;
    protected $user;

    /**
     * LeadsController constructor.
     * @param LeadRepository $lead
     * @param LeadAssigneeRepository $leadAssignee
     * @param LeadNotesRepository $leadNotes
     * @param UserRepository $user
     * @param LeadsTransformer $leadsTransformer
     * @param LeadSourceTransformer $leadSourceTransformer
     * @param GenderTransformer $genderTransformer
     */
    public function __construct(
        LeadRepository $lead,
        LeadAssigneeRepository $leadAssignee,
        LeadNotesRepository $leadNotes,
        UserRepository $user,
        LeadsTransformer $leadsTransformer,
        LeadSourceTransformer $leadSourceTransformer,
        GenderTransformer $genderTransformer
    ) {
        $this->lead = $lead;
        $this->leadAssignee = $leadAssignee;
        $this->leadNotes = $leadNotes;
        $this->user = $user;
        $this->leadsTransformer = $leadsTransformer;
        $this->leadSourceTransformer = $leadSourceTransformer;
        $this->genderTransformer = $genderTransformer;
    }

    public function index()
    {
        return view('leads.index');
    }

    public function create(Lead $lead = null)
    {
        if ($lead) {
            $this->authorize('manageLead', $lead);
        }

        $leadSources = $this->leadSourceTransformer->mapCollection(
            auth()->user()->company->leadSources
        );

        $genders = $this->genderTransformer->mapCollection(Gender::all());

        return view('leads.create', [
            'lead' => $lead,
            'leadSources' => $leadSources,
            'genders' => $genders
        ]);
    }

    public function show(Lead $lead)
    {
        $this->authorize('manageLead', $lead);

        $notes = $this->leadNotes->getNotes($lead);

        return view('leads.details', [
            'lead' => $lead,
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

        return $this->leadsTransformer->mapCollection($leads);
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

    public function reassign(Lead $lead)
    {
        $this->authorize('reassign', $lead);

        DB::transaction(function () use ($lead) {
            $user = $this->user->findById(request('user_id'));

            $lead->assign($user);

            flash('Lead reassigned successfully', 'success');

            //send mailer to the user who has been assigned to the lead
            //send another notification to the previous lead owner
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
