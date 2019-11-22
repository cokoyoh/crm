<?php


namespace CRM\Transformers;


class DealTransformer extends Transformer
{

    public function transform($deal)
    {
        $user = $deal->user;

        return [
            'id' => $deal->id,
            'name' => $deal->name,
            'amount' => number_format($deal->amount),
            'product' => optional($deal->product)->name,
            'user' => $user ? $user->name : '',
            'stage' => optional($deal->stage)->name,
            'company' => $user ? optional($user->company)->name : '',
            'date' => $deal->created_at->toFormattedDateString(),
            'viewable' => $this->viewable($deal)
        ];
    }

    private function viewable($deal)
    {
        return $deal->user_id == auth()->id();
    }
}
