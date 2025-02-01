<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('crypto_prices', function (Blueprint $table) {
            $table->id();
            $table->string('currency');
            
            $table->decimal('price_usd', 15, 8);
            $table->decimal('price_eur', 15, 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_prices');
    }
};
