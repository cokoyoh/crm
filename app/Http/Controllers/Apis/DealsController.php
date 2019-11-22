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

    public function pending()
    {
        $deals = $this->dealsRepository->pending();

        return $this->respondWithJson(
            (new DealTransformer())->transformCollection($deals)
        );
    }

    public function lost()
    {
        $deals = $this->dealsRepository->lost();

        return $this->respondWithJson(
            (new DealTransformer())->transformCollection($deals)
        );
    }

    public function won()
    {
        $deals = $this->dealsRepository->won();

        return $this->respondWithJson(
            (new DealTransformer())->transformCollection($deals)
        );
    }

    public function verified()
    {
        $deals = $this->dealsRepository->verified();

        return $this->respondWithJson(
            (new DealTransformer())->transformCollection($deals)
        );
    }
}
