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
        Schema::create('transfer_reservas', function (Blueprint $table) {
            $table->id('id_reserva');
            $table->string('localizador', 100);
            $table->foreignId('id_hotel')->nullable()->constrained('transfer_hotel', 'id_hotel')->onDelete('set null');
            $table->foreignId('id_tipo_reserva')->constrained('transfer_tipo_reserva', 'id_tipo_reserva');
            $table->string('email_cliente', 255);
            $table->dateTime('fecha_reserva');
            $table->dateTime('fecha_modificacion');
            $table->foreignId('id_destino')->nullable()->constrained('transfer_hotel', 'id_hotel')->onDelete('set null');
            $table->date('fecha_entrada')->nullable();
            $table->time('hora_entrada')->nullable();
            $table->string('numero_vuelo_entrada', 50);
            $table->string('origen_vuelo_entrada', 255)->nullable();
            $table->time('hora_vuelo_salida')->nullable();
            $table->date('fecha_vuelo_salida')->nullable();
            $table->integer('num_viajeros');
            $table->foreignId('id_vehiculo')->constrained('transfer_vehiculo', 'id_vehiculo');
            $table->time('hora_recogida')->nullable();
            $table->tinyInteger('creado_por_admin')->default(0);
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