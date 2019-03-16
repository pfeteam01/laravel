<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAnnonceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('table_annonce', function ($t) {
           $t->double('surface_bien');
           $t->foreign('surface_bien')
                 ->references('surface')
                 ->on('table_typeBien');
           $t->double('prix');
           $t->boolean('desactive')->default('0');
           $t->enum('type_action', array('location','vente' ));
           $t->enum('typeDuBien', array('domicile', 'terrain'));
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('table_annonce', function ($t) {
            $t->dropColumn('surface_bien','prix','type1','type2');
        });
    }
}
