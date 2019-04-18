<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colocations', function (Blueprint $table) {
            $table->primary('id_colocation');
            $table->integer('id_colocation');
            $table->foreign('id_colocation')->references('id_annonce')->on('annonces');
            $table->bigInteger('loyer');
            $table->bigInteger('charge');
            $table->bigInteger('depot_de_garantie');
            $table->date('date_de_disponibilite');
            $table->bigInteger('duree_min')->nullable();
            $table->bigInteger('superficie_de_la_chambre');
            $table->integer('nombre_de_colocataires');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colocations');
    }
}
