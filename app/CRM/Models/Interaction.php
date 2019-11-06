<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interaction extends Model
{
    use SoftDeletes;

    protected $table = 'interactions';

    protected $guarded = [];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
