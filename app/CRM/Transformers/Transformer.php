<?php


namespace CRM\Transformers;


use Illuminate\Database\Eloquent\Collection;

abstract class Transformer
{
    public function transformCollection(Collection $items)
    {
        return $items
            ->map(function ($item) {
               return $this->transform($item);
            });
    }

    public abstract function transform($item);
}
