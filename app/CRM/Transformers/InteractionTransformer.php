<?php


namespace CRM\Transformers;


use Illuminate\Support\Str;

class InteractionTransformer extends Transformer
{
    public function transform($interaction)
    {
         return [
             'id' => $interaction->id,
             'body' => Str::limit($interaction->body, 150),
             'date' => $interaction->created_at->toFormattedDateString(),
             'time' => $interaction->created_at->format('g:i a')
         ];
    }

}
