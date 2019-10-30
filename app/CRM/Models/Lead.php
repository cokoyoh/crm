<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $table = 'leads';

    protected $guarded = [];

    public function leadAssignee()
    {
        return $this->hasOne(LeadAssignee::class);
    }
}
