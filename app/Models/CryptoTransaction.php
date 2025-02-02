<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoTransaction extends Model
{
    protected $fillable = ['account_id', 'type', 'amount', 'description'];

    public function account()
    {
        return $this->belongsTo(CryptoAccount::class, 'account_id');
    }
}
