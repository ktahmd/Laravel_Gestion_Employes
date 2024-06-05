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
        Schema::create('RRH', function (Blueprint $table) {
            $table->id();
           
            $table->bigInteger('employe_id')->unsigned();
            $table->timestamps();
            $table->foreign('employe_id')->references('id')->on('Employes')->onDelete('cascade');
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RRH');
    }
};