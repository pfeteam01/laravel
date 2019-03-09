<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Maison extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_maison', function (Blueprint $table) {
            $table->integer('id_domicile')->unsigned();
            $table->foreign('id_domicile')
                  ->references('id_typeBien')
                  ->on('domicile')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->integer('nbr_etage');
            $table->boolean('jardin');
            $table->boolean('piscine');
            $table->boolean('garage');
           
            
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
