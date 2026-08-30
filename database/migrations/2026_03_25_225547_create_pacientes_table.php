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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_documento', 20)->nullable();
            $table->string('numero_documento', 30)->unique();
            $table->string('nombres', 150);
            $table->string('apellidos', 150);
            $table->string('telefono', 30)->nullable();
            $table->string('correo', 150)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->boolean('estado')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
