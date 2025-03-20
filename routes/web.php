<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::view('/dashboard/bitcoin','dashboard.bitcoin')->name('bitcoin');
    Route::get('/dashboard/bank', function () {
        return view('dashboard.bank');
    })->name('bank');
    
    Route::get('/dashboard/analysis', function () {
        return view('dashboard.analysis');
    })->name('analysis');
    
    Route::get('/dashboard/forecasts', function () {
        return view('dashboard.bank');
    })->name('forecasts');
    
    Route::get('/dashboard/learn', function () {
        return view('dashboard.learn');
    })->name('learn');
    

    Route::prefix('dashboard/investments')->group(function () {
        Route::get('/stocks', function () {
            return view('dashboard.stocks');
        })->name('stocks');
        Route::get('/bonds', function () {
            return view('dashboard.bonds');
        })->name('bonds');
        Route::get('/real-estate', function () {
            return view('dashboard.real-estate');
        })->name('real-estate');
        Route::get('/mutual-funds', function () {
            return view('dashboard.mutual-funds');
        })->name('mutual-funds');
        Route::get('/etfs', function () {
            return view('dashboard.etfs');
        })->name('etfs');
        Route::get('/commodities', function () {
            return view('dashboard.commodities');
        })->name('commodities');
        Route::get('/crypto', function () {
            return view('dashboard.crypto');
        })->name('crypto');
    });

    Route::prefix('dashboard/create')->group(function () {
        Route::get('/bitcoin', function () {
            return view('dashboard.create.bitcoin-account');
        })->name('create_bitcoin_account');
        Route::get('/bank', function () {
            return view('dashboard.create.bank-account');
        })->name('create_bank_account');
        Route::get('/stocks', function () {
            return view('dashboard.create_stocks');
        })->name('create_stocks');
        Route::get('/bonds', function () {
            return view('dashboard.create_bonds');
        })->name('create_bonds');
        Route::get('/real-estate', function () {
            return view('dashboard.create_real_estate');
        })->name('create_real_estate');
        Route::get('/mutual-funds', function () {
            return view('dashboard.create_mutual_funds');
        })->name('create_mutual_funds');
        Route::get('/etfs', function () {
            return view('dashboard.create_etfs');
        })->name('create_etfs');
        Route::get('/commodities', function () {
            return view('dashboard.create_commodities');
        })->name('create_commodities');
        Route::get('/crypto', function () {
            return view('dashboard.create.crypto');
        })->name('create_crypto');
    });
});

require __DIR__.'/socialstream.php';