<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use phpseclib3\Crypt\DES;

class Asset extends Model
{
    protected $fillable = [
        'depot_id',
        'name',
        'description',
        'balance',
        'currency',
        'type_of_currency',
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function depot()
    {
        return $this->belongsTo(Depot::class);
    }
}
