<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //une migration sert a modifier et creer la structure du bdd avec du code sans toucher a phpmy admin
    //c-a-d une creation de table
    public function up(): void // ecrit ce qu'il faut faire 
    {
        //creation de la table
        Schema::create('formateurs', function (Blueprint $table) {
            //colonne dans la table formateur
            $table->id();
            $table->string('nom_formateur');
            $table->string('prenom_formateur');
            $table->string('email')->unique();
            $table->string('telephone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void //annuler le changement 
    {
        Schema::dropIfExists('formateurs');
    }
};
