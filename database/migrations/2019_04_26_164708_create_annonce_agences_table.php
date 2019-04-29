<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnonceAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonce_agences', function (Blueprint $table) {
            $table->primary('id_annonce');
            $table->integer('id_annonce');
            $table->integer('agence_id')->unsigned();
            $table->foreign('agence_id')->references('id_agence')->on('agences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('annonce_agences');
    }
}
