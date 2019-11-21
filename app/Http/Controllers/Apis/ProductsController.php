<?php

namespace App\Http\Controllers\Apis;

use CRM\Transformers\ProductTransformer;

class ProductsController extends ApiController
{
    public function index()
    {
        $products = auth()->user()->company->products()->latest()->paginate(8);

        return $this->respondWithJson(
            (new ProductTransformer())->transformCollection($products)
        );
    }
}
