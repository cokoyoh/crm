<?php


namespace Tests\Setup;


use CRM\Models\Contact;
use CRM\Models\ContactStatus;
use CRM\Models\ContactUser;

class ContactFactory
{
    public $lead = null;
    public $user = null;
    public $status = 'prospect';

    public function create()
    {
        $contact = create(Contact::class, [
            'lead_id' => $this->lead ? $this->lead->id : null
        ]);

        if ($this->user) {
            create(ContactUser::class, [
                'user_id' => $this->user->id,
                'contact_id' => $contact->id
            ]);
        }

        create(ContactStatus::class, ['slug' => $this->status]);

        return $contact;
    }

    public function withStatus($status = null)
    {
        $this->status = $status ?? $this->status;

        return $this;
    }

    public function associatedWith($lead)
    {
        $this->lead = $lead;

        return $this;
    }

    public function assignTo($user)
    {
        $this->user = $user;

        return $this;
    }
}
