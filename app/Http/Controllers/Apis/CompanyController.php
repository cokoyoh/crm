<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use CRM\Companies\CompanyRepository;
use CRM\Transformers\CompanyTransformer;
use Illuminate\Http\Request;

class CompanyController extends ApiController
{
    protected $companyRepository;

    /**
     * CompanyController constructor.
     * @param $companyRepository
     */
    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


    public function index()
    {
        $paginatedCompanies = $this->companyRepository->all();

        return $this->respondWithJson(
            (new CompanyTransformer())->transformCollection($paginatedCompanies)
        );
    }
}
