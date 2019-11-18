<?php


namespace CRM\Transformers;


class GenderTransformer extends Transformer
{

    public function transform($gender)
    {
        return [
            'id' => $gender->id,
            'name' => $gender->name,
            'slug' => $gender->slug
        ];
    }
}
