<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationAgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_agences', function (Blueprint $table) {
            $table->integer('id_notification');
            $table->primary('id_notification');
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
        Schema::dropIfExists('notification_agences');
    }
}
