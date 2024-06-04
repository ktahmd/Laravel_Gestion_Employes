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
        Schema::create('abssences', function (Blueprint $table) {
            $table->id();
            $table->integer('durre');

            $table->bigInteger('horaire_id')->unsigned();
            $table->timestamps();
            $table->foreign('horaire_id')->references('id')->on('horaire_travails')->onDelete('cascade');
           

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abssences');
    }
};
