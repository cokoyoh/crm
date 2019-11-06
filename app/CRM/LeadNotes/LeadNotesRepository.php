<?php


namespace CRM\LeadNotes;


use CRM\Models\Lead;

class LeadNotesRepository
{
    public function getNotes(Lead $lead)
    {
        return $lead->notes()
            ->where('user_id', auth()->id())
            ->first();
    }
}
