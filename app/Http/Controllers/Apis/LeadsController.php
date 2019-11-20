<?php

namespace App\Http\Controllers\Apis;


use CRM\Leads\LeadRepository;
use CRM\Models\Company;
use CRM\Models\Lead;
use CRM\Models\User;
use CRM\Transformers\InteractionTransformer;
use CRM\Transformers\LeadSourceTransformer;
use CRM\Transformers\LeadsTransformer;

class LeadsController extends ApiController
{
    protected $leadRepository;

    /**
     * LeadsController constructor.
     * @param $leadRepository
     */
    public function __construct(LeadRepository $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }


    public function companyLeadSources(Company $company)
    {
        $paginatedLeadSources = $company->leadSources()->latest()->paginate(8);

        $data = (new LeadSourceTransformer())->transformCollection($paginatedLeadSources);

        return $this->respondWithJson($data);
    }

    public function leads(User $user)
    {
        $paginatedLeads = $this->leadRepository->getUserLeads($user);

        return $this->respondWithJson(
            (new LeadsTransformer())->transformCollection($paginatedLeads)
        );
    }

    public function assigned()
    {
        $assignedLeads = $this->leadRepository->assigned();

        return $this->respondWithJson(
            (new LeadsTransformer())->transformCollection($assignedLeads)
        );
    }

    public function interactions(Lead $lead)
    {
        $paginatedLeadInteractions = $this->leadRepository->getInteractions($lead);

        return $this->respondWithJson(
            (new InteractionTransformer())->transformCollection($paginatedLeadInteractions)
        );
    }
}
