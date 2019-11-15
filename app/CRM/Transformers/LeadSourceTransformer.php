<?php


namespace CRM\Transformers;


class LeadSourceTransformer extends Transformer
{

    public function transform($leadSource)
    {
        return [
            'id' => $leadSource->id,
            'name' => $leadSource->name,
            'date' => $leadSource->created_at->toDateString()
        ];
    }
}
