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
        Schema::table('transfer_precios', function (Blueprint $table) {
            $table->foreign(['id_hotel'], 'FK_PRECIOS_HOTEL')->references(['id_hotel'])->on('transfer_hotel')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_vehiculo'], 'FK_PRECIOS_VEHICULO')->references(['id_vehiculo'])->on('transfer_vehiculo')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transfer_precios', function (Blueprint $table) {
            $table->dropForeign('FK_PRECIOS_HOTEL');
            $table->dropForeign('FK_PRECIOS_VEHICULO');
        });
    }
};
