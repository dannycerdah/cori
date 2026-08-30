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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('especialidad_id')->constrained('especialidades');
            $table->string('nombre', 150);
            $table->string('descripcion', 500)->nullable();
            $table->boolean('requiere_doctor')->default(false);
            $table->boolean('estado')->default(true);
            $table->timestamps();

            $table->unique(['especialidad_id', 'nombre'], 'uk_servicio_especialidad');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicios');
    }
};
