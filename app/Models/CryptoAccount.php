<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoAccount extends Model
{
    protected $fillable = ['name', 'balance', 'currency'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function updateBalance($amount, $type)
    {
        if ($type === 'credit') {
            $this->increment('balance', $amount);
        } elseif ($type === 'debit') {
            $this->decrement('balance', $amount);
        }
    }
}
