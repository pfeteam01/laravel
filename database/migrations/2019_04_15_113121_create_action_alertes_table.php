<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionAlertesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_alertes', function (Blueprint $table) {
            $table->increments('id_action');
            $table->integer('alerte_id');
            $table->foreign('alerte_id')->references('id_alerte')->on('alertes');
            $table->enum('nom_type_action',['vente','location','colocation']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_alertes');
    }
}
