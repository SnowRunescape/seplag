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
        Schema::create('lotacao', function (Blueprint $table) {
            $table->increments('lot_id');
            $table->unsignedInteger('unid_id');
            $table->unsignedInteger('pes_id');
            $table->date('lot_data_lotacao');
            $table->date('lot_data_remocao');
            $table->string('lot_portaria', 100);
            $table->timestamps();

            $table->foreign('unid_id')->references('unid_id')->on('unidade')->onDelete('cascade');
            $table->foreign('pes_id')->references('pes_id')->on('pessoa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lotacao');
    }
};
