<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->primary('id_location');
            $table->integer('id_location');
            $table->foreign('id_location')->references('id_annonce')->on('annonces');
            $table->integer('loyer');
            $table->integer('charge');
            $table->integer('depot_de_garantie');
            $table->date('date_de_disponibilite');
            $table->integer('duree_min')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
