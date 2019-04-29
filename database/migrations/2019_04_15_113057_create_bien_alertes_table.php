<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBienAlertesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bien_alertes', function (Blueprint $table) {
            $table->increments('id_bien');
            $table->integer('alerte_id');
            $table->foreign('alerte_id')->references('id_alerte')->on('alertes');
            $table->enum('nom_type_bien',['appartement','maison','studio','terrain','garage']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bien_alertes');
    }
}
