<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;

Schedule::call(function () {
    $client = new \GuzzleHttp\Client();
    $response = $client->get('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd&include_24hr_change=true');
    $data = json_decode($response->getBody(), true);
    $change = $data['bitcoin']['usd_24h_change'];
    Notification::create([
        'title' => "Bitcoin ist um " . round($change, 3) . ($change >= 0 ? ' gestiegen' : ' gefallen'),
        'message' => "Test try",
        'type' => "mood-empty",
        'status' => "read"
    ]);
})->everyMinute();

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
