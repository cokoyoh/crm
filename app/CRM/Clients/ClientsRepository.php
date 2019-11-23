<?php


namespace CRM\Clients;


use CRM\Models\Client;

class ClientsRepository
{
    public function findOrCreateClientByContactId($contactId)
    {
        $client = Client::where('contact_id', $contactId)->first();

        if (is_null($client)) {
            $client = Client::create(['contact_id' => $contactId]);
        }

        return $client;
    }
}
