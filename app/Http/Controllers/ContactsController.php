<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Apis\ApiController;
use CRM\Models\Contact;
use CRM\Transformers\ContactTransformer;

class ContactsController extends ApiController
{
    public function userContacts()
    {
        $searchString = request('query');

        $sources = Contact::query()
            ->whereHas('contactUser', function ($contactUser) {
                $contactUser->where('user_id', auth()->id());
            })
            ->where('email', 'like', "%{$searchString}%")
            ->orWhere('first_name', 'like', "%{$searchString}%")
            ->orWhere('last_name', 'like', "%{$searchString}%")
            ->get();

        return $this->respondWithJson(
            (new ContactTransformer())->mapCollection($sources)
        );
    }
}
