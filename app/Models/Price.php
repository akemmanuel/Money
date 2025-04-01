<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Exceptions\Renderer\Exception;
use Illuminate\Support\Facades\Log;

class Price extends Model
{
    protected $fillable = [
        'currency',
        'type',
        'usd',
    ];
    public function scopeCurrency($query, $currency)
    {
        return $query->where('currency', $currency);
    }
    public function getPriceUsd($currency, $type)
    {
        if ($type == 'fiats') {
            return $this->getFiatsUsd($currency);
        }
        elseif ($type == 'crypto') {
            return $this->getCryptosUsd($currency);
        }
        elseif ($type == 'stocks') {
            return $this->getStocksUsd($currency);
        }
        elseif ($type == 'commodities') {
            return $this->getCommoditiesUsd($currency);
        }
        elseif ($type == 'etfs') {
            return $this->getEtfsUsd($currency);
        }
    }

    public function getFiatsUsd($currency)
    {
        $currencylower = strtolower($currency);
        $price = self::where('currency', $currency)->latest()->first();
        if ($price && $price->updated_at > now()->subDay()) {
            Log::info("Returning cached fiat price for {$currency}: {$price->usd}");
            return $price->usd;
        }
        try {
            $response = file_get_contents("https://latest.currency-api.pages.dev/v1/currencies/" . $currencylower . ".json");
        } catch (Exception $e) {
            Log::error("Error fetching fiat price for {$currency}: " . $e->getMessage());
            return "Error";
        }
        $data = json_decode($response, true);
        if (isset($data[$currencylower]["usd"])) {
            $this->create(
            ['currency' => $currency, 'usd' => $data[$currencylower]["usd"], 'type' => 'fiats']
            );
            Log::info("Fetched and stored fiat price for {$currency}: {$data[$currencylower]["usd"]}");
            return $data[$currencylower]["usd"];
        }
        Log::warning("Fiat price for {$currency} not found in API response.");
        // return "Error getting current price";
        // TODO: Error handling    
        return "Error";
    }

    public function getCryptosUsd($currency)
    {
        $price = self::where('currency', $currency)->latest()->first();
        if ($price && $price->updated_at > now()->subMinutes(20)) {
            return $price->usd;
        }
        try {
            $response = file_get_contents("https://min-api.cryptocompare.com/data/price?fsym={$currency}&tsyms=USD");
        } catch (Exception $e) {
            return "Error";
        }
        $data = json_decode($response, true);

        if (isset($data['USD'])) {
            $this->create(
                ['currency' => $currency, 'usd' => $data['USD'], 'type' => 'crypto']
            );
            return $data['USD'];
        }
        // return "Error getting current price";
        // TODO: Error handling
    }

    public function getStocksUsd($currency)
    {
        $price = self::where('currency', $currency)->latest()->first();
        if ($price && $price->updated_at > now()->subMinutes(20)) {
            return $price->usd;
        }
        try {
            $response = file_get_contents("https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol={$currency}&apikey=FK1HFM2IIH4BRBDL");
        } catch (Exception $e) {
            return "Error";
        }
        $data = json_decode($response, true);

        if (isset($data['Global Quote']['05. price'])) {
            $this->create(
                ['currency' => $currency, 'usd' => $data['Global Quote']['05. price'], 'type' => 'stocks']
            );
            return $data['Global Quote']['05. price'];
        }
        // return "Error getting current price";
        // TODO: Error handling
    }

    public function getCommoditiesUsd($currency)
    {
        $price = self::where('currency', $currency)->latest()->first();
        if ($price && $price->updated_at > now()->subHour()) {
            return $price->usd;
        }
        if (in_array($currency, ['XAU', 'XAG', 'HG', 'XPD'])) { 
            try {
                $response = file_get_contents("https://api.gold-api.com/price/{$currency}");
            } catch (Exception $e) {
                return "Error";
            }
            $data = json_decode($response, true);

            if (isset($data['price'])) {
                $this->create(
                    ['currency' => $currency, 'usd' => $data['price'], 'type' => 'commodities']
                );
                return $data['price'];
            }
            // return "Error getting current price";
            // TODO: Error handling
        } else {
            return "Error";
        }
    }

    public function getEtfsUsd($currency)
    {
        # Implement it later
    }
}
// FK1HFM2IIH4BRBDL