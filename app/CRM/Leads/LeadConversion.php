<?php


namespace CRM\Leads;


use CRM\Models\Contact;
use CRM\Models\ContactStatus;

trait LeadConversion
{
    public function convert()
    {
        $contact = $this->createContact();

        $this->assignContactToAuthUser($contact);
    }

    private function createContact()
    {
        return $this->contact()->create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'contact_status_id' => $this->getContactStatusId()
        ]);
    }

    private function assignContactToAuthUser(Contact $contact)
    {
        return $contact->contactUser()->create(['user_id' => auth()->id()]);
    }

    private function getContactStatusId($slug = 'prospect')
    {
        $contactStatus = ContactStatus::where('slug', $slug)->first();

        return $contactStatus ? $contactStatus->id : null;
    }
}
