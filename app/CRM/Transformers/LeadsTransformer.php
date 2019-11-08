<?php


namespace CRM\Transformers;


class LeadsTransformer extends Transformer
{

    public function transform($lead)
    {
        return [
            'id' => $lead->id,
            'name' => $lead->name
        ];
    }
}
