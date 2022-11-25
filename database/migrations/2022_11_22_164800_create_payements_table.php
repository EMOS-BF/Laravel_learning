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
        Schema::create('payements', function (Blueprint $table) {
            $table->id();
            $table->double("Montant");
            $table->dateTime("datePaiement");
            $table->unsignedBigInteger('location_id');
            $table->foreign('location_id')->references('id')->on('locations');
            //$table->foreignId('location_id')->constrained();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
           // $table->foreignId('user_id')->constrained();
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
        Schema::table('payements', function(Blueprint $table){
            $table->dropForeign(["location_id","users_id"]);
        });
        
        Schema::dropIfExists('payements');
    }
};
