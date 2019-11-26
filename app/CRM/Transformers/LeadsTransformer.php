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
            'viewable' => $this->viewable($lead),
            're_assignable' => $this->isReAssignable($lead)
        ];
    }

    private function assignable($lead)
    {
        return $this->hasNoContact($lead);
    }

    private function viewable($lead)
    {
        $user = auth()->user();

        return $user ? $lead->isAssigned($user) : false;
    }

    private function isReAssignable($lead)
    {
        return auth()->user()->isAdmin()
            && $this->hasNoContact($lead)
            && $this->belongToSameCompany($lead);
    }

    private function hasNoContact($lead)
    {
        return is_null($lead->contact);
    }

    private function belongToSameCompany($lead)
    {
        return $lead->company_id == auth()->user()->company_id;
    }
}
