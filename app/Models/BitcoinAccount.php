<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BitcoinAccount extends Model
{
    protected $fillable = ['name', 'display', 'balance'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
