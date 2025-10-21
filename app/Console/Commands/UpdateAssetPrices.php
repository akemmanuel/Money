<?php

namespace App\Console\Commands;

use App\Models\Asset;
use App\Models\Price;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateAssetPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prices:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetches and updates the latest prices for all assets.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting asset price update...');

        $assets = Asset::select('currency', 'type_of_currency')
            ->distinct()
            ->get();

        $priceService = new Price();

        foreach ($assets as $asset) {
            try {
                $price = $priceService->getPriceUsd($asset->currency, $asset->type_of_currency);
                if ($price !== "Error") {
                    // The getPriceUsd method already creates a new Price entry if updated
                    $this->info("Updated price for {$asset->currency} ({$asset->type_of_currency}): {$price}");
                } else {
                    $this->warn("Could not fetch price for {$asset->currency} ({$asset->type_of_currency}).");
                }
            } catch (\Exception $e) {
                Log::error("Error updating price for {$asset->currency} ({$asset->type_of_currency}): " . $e->getMessage());
                $this->error("Error updating price for {$asset->currency} ({$asset->type_of_currency}). Check logs for details.");
            }
        }

        $this->info('Asset price update finished.');
    }
}