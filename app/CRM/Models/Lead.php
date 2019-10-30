<?php

namespace CRM\Models;

use CRM\LeadClasses\ChangeLeadClass;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use ChangeLeadClass;

    protected $table = 'leads';

    protected $guarded = [];

    public function leadAssignee()
    {
        return $this->hasOne(LeadAssignee::class);
    }
}
