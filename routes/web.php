<?php

use App\Livewire\CreateTransaction;
use App\Livewire\Portfolio;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
     
        Route::get('/portfolio', function () {
            return view('livewire.portfolio');
        })->name('portfolio');
        Route::get('/transactions/create', CreateTransaction::class)->name('transactions.create');

    Route::get('/settings', [App\Http\Controllers\UserProfileController::class, 'showSettingsForm'])->name('settings');

    Route::get('/bonds', function () {
        return view('bonds');
    })->name('bonds');

    Route::get('/real-estate', App\Livewire\RealEstate::class)->name('real-estate');

    Route::get('/mutual-funds', App\Livewire\MutualFunds::class)->name('mutual-funds');

    Route::get('/forecasts', function () {
        return view('forecasts');
    })->name('forecasts');

    Route::get('/analysis', function () {
        return view('analysis');
    })->name('analysis');

    Route::get('/learn', function () {
        return view('learn');
    })->name('learn');

    Route::get('/ask-gemini', App\Livewire\AskGemini::class)->name('ask-gemini');
});

require __DIR__.'/socialstream.php';

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});