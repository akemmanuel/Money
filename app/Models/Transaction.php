<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['asset_id', 'type', 'title', 'description', 'amount'];
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}