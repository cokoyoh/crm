<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $guarded = [];

    public function contactUser()
    {
        return $this->hasOne(ContactUser::class);
    }
}
