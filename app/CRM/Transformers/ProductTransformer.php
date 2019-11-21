<?php


namespace CRM\Transformers;


class ProductTransformer extends Transformer
{

    public function transform($product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'date' => $product->created_at->toFormattedDateString()
        ];
    }
}
