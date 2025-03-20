<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['bitcoin_account_id', 'amount', 'type', 'usd', 'eur'];
    public function account()
    {
        return $this->belongsTo(BitcoinAccount::class);
    }
}