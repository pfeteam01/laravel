<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChambreAlertesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chambre_alertes', function (Blueprint $table) {
            $table->increments('id_chambre');
            $table->integer('alerte_id');
            $table->foreign('alerte_id')->references('id_alerte')->on('alertes');
            $table->enum('nb_chambres',[1,2,3,4,5,6,7,8]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chambre_alertes');
    }
}
