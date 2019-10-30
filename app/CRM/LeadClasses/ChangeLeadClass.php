<?php


namespace CRM\LeadClasses;


use CRM\Models\LeadClass;

trait ChangeLeadClass
{
    public function markAsNotFollowedUp()
    {
        $leadClass = $this->getLeadClassBySlug('not_followed_up');

        $this->lead_class_id = $leadClass->id;

        $this->save();
    }

    private function getLeadClassBySlug($slug = 'not_followed_up')
    {
        return LeadClass::whereSlug($slug)->first();
    }
}
