<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppartementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appartements', function (Blueprint $table) {
            $table->primary('id_appartement');
            $table->integer('id_appartement');
            $table->foreign('id_appartement')->references('id_annonce')->on('annonces');
            $table->integer('nb_pieces');
            $table->integer('nb_chambres');
            $table->integer('nb_toilettes');
            $table->integer('nb_salles_de_bain');
            $table->integer('nb_balcons');
            $table->integer('num_etage');
            $table->boolean('meuble');
            $table->boolean('parking');
            $table->boolean('assenceur');
            $table->boolean('interphone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appartements');
    }
}
