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

    public function index()
    {
        $this->authorize('view', Product::class);

        return view('products.index');
    }


    public function store()
    {
        $this->authorize('manageProduct', new Product());

        $product = $this->product->create(request()->validate(['name' => 'required']));

        if (request()->wantsJson()) {
            return $this->respondSuccess([
                'id' => $product->id,
                'message' => 'Product added successfully'
            ]);
        }

        flash('Product added successfully', 'success');

        return redirect()->back();
    }

    public function destroy(Product $product)
    {
        $this->authorize('destroy', $product);
    }
}
