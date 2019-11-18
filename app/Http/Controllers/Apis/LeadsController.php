<?php

namespace App\Http\Controllers\Apis;


use CRM\Models\Company;
use CRM\Transformers\LeadSourceTransformer;

class LeadsController extends ApiController
{
    public function companyLeadSources(Company $company)
    {
        $paginatedLeadSources = $company->leadSources()->paginate(8);

        $data = (new LeadSourceTransformer())->transformCollection($paginatedLeadSources);

        return $this->respondWithJson($data);
    }
}
