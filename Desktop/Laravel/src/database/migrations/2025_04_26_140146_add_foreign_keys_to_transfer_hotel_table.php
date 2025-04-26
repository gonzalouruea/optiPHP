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
        Schema::table('transfer_hotel', function (Blueprint $table) {
            $table->foreign(['id_zona'], 'FK_HOTEL_ZONA')->references(['id_zona'])->on('transfer_zona')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transfer_hotel', function (Blueprint $table) {
            $table->dropForeign('FK_HOTEL_ZONA');
        });
    }
};
