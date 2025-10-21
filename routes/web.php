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

    Route::get('/portfolio', Portfolio::class)->name('portfolio');
    Route::get('/transactions/create', CreateTransaction::class)->name('transactions.create');
});

require __DIR__.'/socialstream.php';