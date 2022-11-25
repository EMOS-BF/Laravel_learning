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
        Schema::create('chambre_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId("chambre_id")->constrained();
            $table->foreignId("location_id")->constrained();
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
        Schema::table('chambre_locations', function(Blueprint $table){
            $table->dropForeign(["chambre_id","location_id"]);
        });
        Schema::dropIfExists('chambre_locations');
    }
};
