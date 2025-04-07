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
        Schema::create('servidor_temporario', function (Blueprint $table) {
            $table->unsignedInteger('pes_id')->primary();
            $table->date('ser_data_inicio');
            $table->date('ser_data_fim');
            $table->timestamps();

            $table->foreign('pes_id')->references('pes_id')->on('pessoa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servidor_temporario');
    }
};
