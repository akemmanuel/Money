<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['account_id', 'type', 'title', 'description', 'amount'];
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}