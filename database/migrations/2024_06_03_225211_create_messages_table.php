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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
               
           
            $table->string('contenu',255);
           
            $table->bigInteger('employe_id')->unsigned();
            $table->bigInteger('employe_id_1')->unsigned();
            $table->timestamps();
            $table->foreign('employe_id')->references('id')->on('Employes')->onDelete('cascade');
            $table->foreign('employe_id_1')->references('id')->on('Employes')->onDelete('cascade');
           

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
