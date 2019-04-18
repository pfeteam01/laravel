<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertes', function (Blueprint $table) {
            $table->increments('id_alerte');
            $table->string('wilaya');
            $table->string('mail');
            $table->bigInteger('surface_min')->nullable();
            $table->bigInteger('surface_max')->nullable();
            $table->boolean('etat_alerte');
            $table->bigInteger('lp_min')->nullable();
            $table->bigInteger('lp_max')->nullable();
            $table->integer('user_id');
            $table->foreign('user_id')->references('id_user')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alertes');
    }
}
