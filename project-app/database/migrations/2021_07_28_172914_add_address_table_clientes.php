<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressTableClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->string('cep');
            $table->string('address');
            $table->integer('number');
            $table->string('note');
            $table->string('district');
            $table->string('city');
            $table->string('uf');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropColumn('cep');
            $table->dropColumn('address');
            $table->dropColumn('number');
            $table->string('note');
            $table->dropColumn('district');
            $table->dropColumn('city');
            $table->dropColumn('uf');
        });
    }
}
