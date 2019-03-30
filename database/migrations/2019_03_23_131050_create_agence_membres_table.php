<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenceMembresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agence_membres', function (Blueprint $table) {
            $table->increments('id_membre');
            $table->string('nom_membre',255);
            $table->string('avatar_membre',255)->default('avatar_membre_agence.jpg');
            $table->string('grade_membre',255);
            $table->integer('agence_id');
            $table->foreign('agence_id')->references('id_agence')->on('agences');
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
        Schema::dropIfExists('agence_membres');
    }
}
