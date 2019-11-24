<?php


namespace CRM\Transformers;


class ContactTransformer extends Transformer
{

    public function transform($contact)
    {
        return [
            'id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
        ];
    }
}
