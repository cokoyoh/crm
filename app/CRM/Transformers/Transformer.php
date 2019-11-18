<?php


namespace CRM\Transformers;


abstract class Transformer
{
    public function transformCollection($items)
    {
        return tap($items, function ($items) {
            return $items->getCollection()
                ->transform(function ($item) {
                    return $this->transform($item);
                });
        });
    }

    public function mapCollection($items)
    {
        return $items
            ->map(function ($item) {
                return $this->transform($item);
        });
    }

    public abstract function transform($item);
}
