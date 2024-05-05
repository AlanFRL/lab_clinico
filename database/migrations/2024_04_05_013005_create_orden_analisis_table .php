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
        Schema::create('orden_analisis', function (Blueprint $table) {

            $table->foreignId('orden_id')->constrained('ordenes')->onDelete('cascade');
            $table->foreignId('tipo_analisis_id')->constrained('tipo_analisis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_analisis2s');
    }
};
