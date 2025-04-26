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
        Schema::create('transfer_reservas', function (Blueprint $table) {
            $table->integer('id_reserva', true);
            $table->string('localizador', 100);
            $table->integer('id_hotel')->nullable()->index('fk_reservas_hotel')->comment('Es el hotel que realiza la reserva');
            $table->integer('id_tipo_reserva')->index('fk_reservas_tipo');
            $table->string('email_cliente');
            $table->dateTime('fecha_reserva');
            $table->dateTime('fecha_modificacion');
            $table->integer('id_destino')->nullable()->index('fk_reservas_destino');
            $table->date('fecha_entrada')->nullable();
            $table->time('hora_entrada')->nullable();
            $table->string('numero_vuelo_entrada', 50);
            $table->integer('origen_vuelo_entrada')->nullable();
            $table->time('hora_vuelo_salida')->nullable();
            $table->date('fecha_vuelo_salida')->nullable();
            $table->integer('num_viajeros');
            $table->integer('id_vehiculo')->index('fk_reservas_vehiculo');
            $table->time('hora_recogida')->nullable();
            $table->boolean('creado_por_admin')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_reservas');
    }
};
