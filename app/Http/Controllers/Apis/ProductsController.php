<?php

namespace App\Http\Controllers\Apis;

use CRM\Products\ProductRepository;
use CRM\Transformers\ProductTransformer;

class ProductsController extends ApiController
{
    private  $productsRepository;

    /**
     * ProductsController constructor.
     * @param $productsRepository
     */
    public function __construct(ProductRepository $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }


    public function index()
    {
        $products = $this->productsRepository->getCompanyProducts();

        return $this->respondWithJson(
            (new ProductTransformer())->transformCollection($products)
        );
    }
}
