<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenceCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agence_comments', function (Blueprint $table) {
            $table->primary('id_comment');
            $table->integer('id_comment');
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
        Schema::dropIfExists('agence_comments');
    }
}
