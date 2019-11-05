<?php


namespace CRM\Leads;


trait LeadStatus
{
    public function getStatusAttribute()
    {
        if ($this->lead_class_id == 1) return 'New';

        if ($this->lead_class_id == 4) return 'Lost';

        if ($this->contact) return 'Converted';

        return 'Prospect';
    }
}
