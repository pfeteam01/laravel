<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TypeBien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_typeBien', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('surface');
            $table->integer('annonce_id')->unsigned();
            $table->foreign('annonce_id')
                  ->references('id')
                  ->on('annonces')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typeBien');
    }
}
