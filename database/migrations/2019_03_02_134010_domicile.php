<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class Domicile extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_domicile', function (Blueprint $table) {
           $table->integer('id_typeBien')->unsigned();
            $table->foreign('id_typeBien')
                  ->references('id')
                  ->on('typeBien')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->integer('nbr_piece');
            $table->boolean('balcon');
           
            
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
