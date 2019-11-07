<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;

class LeadAssignee extends Model
{
    protected $table = 'lead_assignees';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
