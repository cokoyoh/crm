<?php

namespace App\Http\Controllers\Apis;

use CRM\Deals\DealsRepository;
use CRM\Transformers\DealTransformer;

class DealsController extends ApiController
{
    private $dealsRepository;

    /**
     * DealsController constructor.
     * @param $dealsRepository
     */
    public function __construct(DealsRepository $dealsRepository)
    {
        $this->dealsRepository = $dealsRepository;
    }


    public function index()
    {
        $deals = $this->dealsRepository->userDeals();

        return $this->respondWithJson(
            (new DealTransformer())->transformCollection($deals)
        );
    }
}
