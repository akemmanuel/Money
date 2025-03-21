<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiat extends Model
{
    protected $fillable = [
        'currency',
        'amount',
    ];

    public function getPrice($currency)
    {
        $price = $this->currency($currency)->latest()->first();
        if ($price && $price->updated_at > now()->subMinutes(2)) {
            return $price->price_usd;
        }
        try {
            $response = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym={$currency}&tsyms=EUR,USD");
        } catch (Exception $e) {
            return "Error";
        }
        $data = json_decode($response, true);

        if (isset($data['EUR']) && isset($data['USD'])) {
            $this->create(
                ['currency' => $currency, 'price_usd' => $data['USD'], 'price_eur' => $data['EUR']]
            );
            return $data['USD'];
        }
        return "Error getting current price";
        // TODO: Error handling
    }

    public function getPriceEur($currency)
    {
        $price = $this->currency($currency)->latest()->first();
        if ($price && $price->updated_at > now()->subMinutes(2)) {
            return $price->price_eur;
        }
        try {
            $response = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym={$currency}&tsyms=EUR,USD");
            $data = json_decode($response, true);
        } catch (Exception $e) {
            return "Error";
        }
        if (isset($data['EUR']) && isset($data['USD'])) {
            $this->create(
                ['currency' => $currency, 'price_usd' => $data['USD'], 'price_eur' => $data['EUR']]
            );
            return $data['EUR'];
        }
        return "Error getting current price";
        // TODO: Error handling
    }
}
