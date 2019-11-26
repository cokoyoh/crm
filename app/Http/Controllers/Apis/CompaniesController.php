<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use CRM\Models\Company;
use CRM\Transformers\DealTransformer;
use Illuminate\Http\Request;

class CompaniesController extends ApiController
{
    public function verifiedDeals(Company $company)
    {
        $verifiedDeals = $company->deals()->verified()->paginate(8);

        return $this->respondWithJson(
            (new DealTransformer())->transformCollection($verifiedDeals)
        );
    }
}
