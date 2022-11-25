<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->char("sexe");
            $table->date("dateNaissance");
            $table->string("lieuNaissance");
            $table->string("nationalité");
            $table->string("ville");
            $table->string("pays");
            $table->string("Adresse")->nullable();
            $table->string("telephone1");
            $table->string("telephone2")->nullable();
            $table->string("pieceIdentité");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
};