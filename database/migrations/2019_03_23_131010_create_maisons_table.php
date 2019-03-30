<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maisons', function (Blueprint $table) {
            $table->primary('id_maison');
            $table->integer('id_maison');
            $table->foreign('id_maison')->references('id_annonce')->on('annonces');
            $table->integer('nb_pieces');
            $table->integer('nb_chambres');
            $table->integer('nb_toilettes');
            $table->integer('nb_salles_de_bain');
            $table->integer('nb_balcons');
            $table->integer('nb_etage');
            $table->boolean('meuble');
            $table->boolean('garage');
            $table->boolean('jardin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maisons');
    }
}
