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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->string('prenom',255);
            $table->string('tel',255);
            $table->string('adress',255);
            $table->string('specialite',255);
            $table->string('img_profit',255);
            $table->string('diplome',255);
            $table->string('contrat_id')->unsigned();
            $table->string('dep_id')->unsigned();
            $table->timestamps();
            $table->foreign('contrat_id')->references('id')->on('Contrats')->onDelete('cascade');
            $table->foreign('dep_id')->references('id')->on('Departements')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
