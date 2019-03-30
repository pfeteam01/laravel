<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agences', function (Blueprint $table) {
            $table->primary('id_agence');
            $table->integer('id_agence');
            $table->foreign('id_agence')->references('id_user')->on('users');
            $table->string('nom',255);
            $table->string('wilaya',255);
            $table->string('adresse',255);
            $table->string('photo_de_couverture',255)->default("default_agence.jpg");
            $table->text('description');
            $table->string('site_web',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agences');
    }
}
