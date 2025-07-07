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
        Schema::create('zona_riesgos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->string('riesgo');
            $table->string('latitud1');
            $table->string('longitud1');
            $table->string('latitud2');
            $table->string('longitud2');
            $table->string('latitud3');
            $table->string('longitud3');
            $table->string('latitud4');
            $table->string('longitud4');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zona_riesgos');
    }
};
