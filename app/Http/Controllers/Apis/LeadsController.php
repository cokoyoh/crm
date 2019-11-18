<?php

namespace App\Http\Controllers\Apis;


use CRM\Leads\LeadRepository;
use CRM\Models\Company;
use CRM\Models\User;
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
        $paginatedLeadSources = $company->leadSources()->paginate(8);

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
}
