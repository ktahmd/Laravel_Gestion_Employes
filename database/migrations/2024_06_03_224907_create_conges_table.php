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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            $table->int('durre');
            $table->string('prenom',255);
            $table->Date('date_conge');
            $table->int('date_prise');
            $table->string('employe_id')->unsigned();
            $table->timestamps();
            $table->foreign('employe_id')->references('id')->on('Employess')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
