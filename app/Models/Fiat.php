<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Fiat extends Model
{
    protected $fillable = [
        'currency',
        'amount',
    ];

    public function usdTo($currency)
    {
        $currencylower = strtolower($currency);

        $price = self::where('currency', $currency)->latest()->first();

        if ($price && $price->updated_at > now()->subDay()) {

            return $price->amount;
        }

        try {
            $response = file_get_contents("https://latest.currency-api.pages.dev/v1/currencies/usd.json");
        } catch (Exception $e) {
            Log::error('Error fetching currency data', ['exception' => $e->getMessage()]);
            return "Error";
        }

        $data = json_decode($response, true);
        if (isset($data["usd"][$currencylower])) {
            $this->create(
                ['currency' => $currency, 'amount' => $data['usd'][$currencylower]]
            );
            return $data["usd"][$currencylower];
        }

        Log::error('Error getting current price', ['currency' => $currency]);
        return "Error getting current price";
    }
}
