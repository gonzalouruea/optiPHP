php
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
        Schema::create('transfer_precios', function (Blueprint $table) {
            $table->id('id_precios');
            $table->foreignId('id_vehiculo')->constrained('transfer_vehiculo', 'id_vehiculo');
            $table->foreignId('id_hotel')->constrained('transfer_hotel', 'id_hotel');
            $table->integer('Precio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_precios');
    }
};