<?php


namespace CRM\Users;


use CRM\Models\Lead;

trait UserLeadsCount
{
    public function getLeadsCountAttribute()
    {
        if ($this->isSuperAdmin()) {
            return Lead::count();
        }

        if ($this->isAdmin()) {
            return count($this->company->leads);
        }

        return $this->leads()->count();
    }
}
