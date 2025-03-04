<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use Illuminate\Support\Facades\Http;

Schedule::call(function () {
    $response = Http::get('https://api.alternative.me/fng/?limit=2');
    $data = $response->json();
    $change = $data['data'][0]['value'] - $data['data'][1]['value'];
    $current = $data['data'][0]['value'];
    Notification::create([
        'title' => "Bitcoin Sentiment ist um " . $change . ($change >= 0 ? ' gestiegen' : ' gefallen'),
        'message' => "Der Bitcoin Sentiment Index ist gerade auf " . $current . ".",
        'icon' => "mood-empty",
        'status' => "read"
    ]);
})->daily(); //At("16:33");

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
