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
        Schema::create('transfer_hotel', function (Blueprint $table) {
            $table->integer('id_hotel', true);
            $table->integer('id_zona')->nullable()->index('fk_hotel_zona');
            $table->integer('Comision');
            $table->string('Usuario', 100);
            $table->string('password', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfer_hotel');
    }
};
