<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Appartement extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_appartemnet', function (Blueprint $table) {
            $table->integer('id_domicile')->unsigned();
            $table->foreign('id_domicile')
                  ->references('id_typeBien')
                  ->on('domicile')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
            $table->integer('num_etage');
            $table->boolean('ascenseur');
            $table->boolean('interphone');
            $table->boolean('parking');
           
            
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
