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
        Schema::create('seguros', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table-> string('nombre');
            $table-> string('radio');
            $table-> string('latitud');
            $table-> string('longitud');
            $table-> string('seguridad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguros');
    }
};
