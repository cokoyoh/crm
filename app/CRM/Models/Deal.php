<?php

namespace CRM\Models;

use CRM\Deals\DealStages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deal extends Model
{
    use SoftDeletes,
        DealStages;

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

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function notes()
    {
        return $this->hasOne(DealNote::class);
    }

    public function addNotes(array $input)
    {
        if ($this->notes) {
            $this->notes()->update($input);

            return $this->notes->fresh();
        }

        return $this->notes()->create($input);
    }

    public function verifiedDeal()
    {
        return $this->hasOne(VerifiedDeal::class);
    }
}
