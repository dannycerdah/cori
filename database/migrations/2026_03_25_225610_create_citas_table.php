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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->cascadeOnDelete();
            $table->foreignId('especialidad_id')->constrained('especialidades');
            $table->foreignId('servicio_id')->constrained('servicios');
            $table->foreignId('doctor_id')->nullable()->constrained('doctores');
            $table->foreignId('horario_id')->nullable()->constrained('horarios');
            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->enum('tipo', ['NORMAL', 'EXCEPCIONAL'])->default('NORMAL');
            $table->enum('estado', ['REGISTRADA', 'CONFIRMADA', 'ATENDIDA', 'CANCELADA', 'NO_ASISTIO'])->default('REGISTRADA');
            $table->string('observacion', 1000)->nullable();
            $table->timestamps();

            $table->index('fecha', 'idx_citas_fecha');
            $table->index(['doctor_id', 'fecha'], 'idx_citas_doctor_fecha');
            $table->index(['horario_id', 'fecha'], 'idx_citas_horario_fecha');
            $table->index('paciente_id', 'idx_citas_paciente');
            $table->index(['servicio_id', 'fecha'], 'idx_citas_servicio_fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
