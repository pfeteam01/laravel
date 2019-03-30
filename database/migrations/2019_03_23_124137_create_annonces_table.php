<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnnoncesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->increments('id_annonce');
            $table->string('titre',255);
            $table->string('wilaya',255);
            $table->string('adresse',255);
            $table->string('mail',255)->nullable();
            $table->string('tel',255)->nullable();
            $table->text('description');
            $table->float('lat',10,8);
            $table->float('lng',10,8);
            $table->integer('superficie');
            $table->boolean('etat');
            $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('annonces');
    }
}
