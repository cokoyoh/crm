<?php


namespace CRM\Transformers;


class LeadsTransformer extends Transformer
{

    public function transform($lead)
    {
        return [
            'id' => $lead->id,
            'name' => $lead->name,
            'phone' => $lead->phone,
            'email' => $lead->email,
            'date' => $lead->created_at->toFormattedDateString(),
            'class_slug' => optional($lead->leadClass)->slug,
            'source' => optional($lead->leadSource)->name,
            'assignable' => $this->assignable($lead),
            'viewable' => $this->viewable($lead)
        ];
    }

    private function assignable($lead)
    {
        return is_null($lead->contact) ? true : false;
    }

    private function viewable($lead)
    {
        $user = auth()->user();

        return $user ? $lead->isAssigned($user) : false;
    }
}
