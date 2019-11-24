<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $guarded = [];

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
