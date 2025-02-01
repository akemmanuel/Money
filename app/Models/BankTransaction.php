<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    protected $fillable = ['account_id', 'type', 'amount', 'description'];

    public function account()
    {
        return $this->belongsTo(BankAccount::class, 'account_id');
    }
}
