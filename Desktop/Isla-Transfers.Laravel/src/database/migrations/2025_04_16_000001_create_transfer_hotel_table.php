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
        Schema::create('transfer_hotel', function (Blueprint $table) {
            $table->id('id_hotel');
            $table->foreignId('id_zona')->nullable()->constrained('transfer_zona', 'id_zona');
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