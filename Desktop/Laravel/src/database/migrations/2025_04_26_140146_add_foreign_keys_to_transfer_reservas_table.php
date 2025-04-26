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
        Schema::table('transfer_reservas', function (Blueprint $table) {
            $table->foreign(['id_destino'], 'FK_RESERVAS_DESTINO')->references(['id_hotel'])->on('transfer_hotel')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_hotel'], 'FK_RESERVAS_HOTEL')->references(['id_hotel'])->on('transfer_hotel')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_tipo_reserva'], 'FK_RESERVAS_TIPO')->references(['id_tipo_reserva'])->on('transfer_tipo_reserva')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['id_vehiculo'], 'FK_RESERVAS_VEHICULO')->references(['id_vehiculo'])->on('transfer_vehiculo')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transfer_reservas', function (Blueprint $table) {
            $table->dropForeign('FK_RESERVAS_DESTINO');
            $table->dropForeign('FK_RESERVAS_HOTEL');
            $table->dropForeign('FK_RESERVAS_TIPO');
            $table->dropForeign('FK_RESERVAS_VEHICULO');
        });
    }
};
