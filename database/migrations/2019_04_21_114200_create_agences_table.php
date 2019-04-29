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
            $table->increments('id_agence');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('avatar')->default('default_avatar_agence.png');
            $table->string('background_img')->default('default_background_img_agence.png');
            $table->string('description',255);
            $table->string('wilaya',255);
            $table->string('adresse',255);
            $table->string('web_site');
            $table->string('password');
            $table->boolean('is_activated')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('agences');
    }
}
