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
        Schema::create('chambres', function (Blueprint $table) {
            $table->id();
            $table->string("numero_de_chambre");
            $table->string("imageUrl")->nullable();
            $table->boolean("EstDisponible")->default(1);
            $table->foreignId("type_chambre_id")->constrained();
            //$table->unsignedBigInteger('user_id');
            //$table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chambres', function(Blueprint $table){
            $table->dropForeign(["type_chambre_id"]);
        });
        
        Schema::dropIfExists('chambres');
    }
};
