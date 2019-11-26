<?php

namespace CRM\Models;

use CRM\Accessors\NameAccessors;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use NameAccessors;

    protected $table = 'contacts';

    protected $guarded = [];

    public function contactUser()
    {
        return $this->hasOne(ContactUser::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
