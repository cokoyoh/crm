<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Apis\ApiController;
use CRM\Models\Product;
use CRM\Products\ProductRepository;

class ProductsController extends ApiController
{
    protected $product;

    /**
     * ProductsController constructor.
     * @param $product
     */
    public function __construct(ProductRepository $product)
    {
        $this->product = $product;
    }


    public function store()
    {
        $this->authorize('manageProduct', new Product());

        $this->product->create(request()->validate(['name' => 'required']));

        if (request()->wantsJson()) {
            return $this->respondSuccess(['message' => 'Product added successfully']);
        }

        flash('Product added successfully', 'success');

        return redirect()->back();
    }
}
