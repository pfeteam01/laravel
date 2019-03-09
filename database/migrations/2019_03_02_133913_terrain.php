<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Terrain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('table_terrain', function (Blueprint $table) {
            $table->integer('id_typeBien')->unsigned();
            $table->foreign('id_typeBien')
                  ->references('id')
                  ->on('typeBien')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->string('act_propriete');
            $table->string('permis_construction');
           
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
