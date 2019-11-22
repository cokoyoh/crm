<?php

namespace CRM\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $table = 'deals';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function stage()
    {
        return $this->belongsTo(DealStage::class, 'deal_stage_id');
    }
}
