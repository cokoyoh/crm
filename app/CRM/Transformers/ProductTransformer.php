<?php


namespace CRM\Transformers;


use CRM\Models\Product;

class ProductTransformer extends Transformer
{

    public function transform($product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'date' => $product->created_at->toFormattedDateString(),
            'deletable' => $this->deletable($product)
        ];
    }

    private function deletable(Product $product)
    {
        $user = auth()->user();

        if (is_null($user)) {
            return false;
        }

        return $user->isAdmin() && $user->company_id == $product->company_id;
    }
}
