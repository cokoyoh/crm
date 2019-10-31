<?php

namespace CRM\Models;

use CRM\LeadClasses\ChangeLeadClass;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use ChangeLeadClass;

    protected $table = 'leads';

    protected $guarded = [];

    protected $hidden = [
        'first_name',
        'last_name'
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function leadAssignee()
    {
        return $this->hasOne(LeadAssignee::class);
    }

    public function leadClass()
    {
        return $this->belongsTo(LeadClass::class);
    }
}
