<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Apis\ApiController;
use CRM\Models\Product;
use CRM\Products\ProductRepository;
use CRM\Transformers\ProductTransformer;

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
        $this->authorize('create', Product::class);

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

        $product->delete();

        if (request()->wantsJson()) {
            return $this->respondSuccess(['message' => 'Product deleted!']);
        }

        return redirect()->back();
    }

    public function products()
    {
        $searchString = request('query');

        $sources = Product::query()
            ->where('company_id', auth()->user()->company_id)
            ->where('name', 'like', "%{$searchString}%")
            ->get();

        return $this->respondWithJson(
            (new ProductTransformer())->mapCollection($sources)
        );
    }
}
