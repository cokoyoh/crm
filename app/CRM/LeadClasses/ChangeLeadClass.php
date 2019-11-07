<?php


namespace CRM\LeadClasses;


use CRM\Models\LeadClass;

trait ChangeLeadClass
{
    public function markAsNotFollowedUp()
    {
        $this->changeClass();
    }

    public function markAsFollowedUp()
    {
        $this->changeClass('followed_up');
    }

    public function markAsLost()
    {
        $this->changeClass('lost');
    }

    public function markAsConverted()
    {
        $this->changeClass('converted');
    }

    private function changeClass($slug = 'not_followed_up')
    {
        $leadClass = $this->getLeadClassBySlug($slug);

        $this->lead_class_id = $leadClass->id;

        $this->save();
    }

    private function getLeadClassBySlug($slug)
    {
        return LeadClass::whereSlug($slug)->first();
    }
}
