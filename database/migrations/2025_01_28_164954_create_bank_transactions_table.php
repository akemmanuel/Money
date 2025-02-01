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
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id'); // Referenz auf das Konto
            $table->enum('type', ['credit', 'debit']); // Ein- oder Auszahlung
            $table->decimal('amount', 15, 2); // Betrag
            $table->text('description')->nullable(); // Beschreibung der Transaktion
            $table->timestamps();

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_transactions');
    }
};
