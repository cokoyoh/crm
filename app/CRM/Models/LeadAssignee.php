<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadAssignee extends Model
{
    use SoftDeletes;

    protected $table = 'lead_assignees';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
