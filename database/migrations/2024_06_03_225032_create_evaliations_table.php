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
        Schema::create('evaliations', function (Blueprint $table) {
            $table->id();
            $table->int('eval_id');
            $table->int('taux_eval');
            $table->int('mois');
            $table->int('anne');
            $table->string('employe_id')->unsigned();
            $table->timestamps();
            $table->foreign('employe_id')->references('id')->on('Employess')->onDelete('cascade');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaliations');
    }
};
