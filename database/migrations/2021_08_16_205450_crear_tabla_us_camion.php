<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsCamion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usCamion', function (Blueprint $table) {
            //
            $table->id();
            $table->foreignId('idUsuario')->constrained('users'); //uniendo los IDS
            $table->foreignId('idCamion')->constrained('camiones'); //unidendo los IDS
           //$table->timestamps(); esto para llevar un control
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usCamion', function (Blueprint $table) {
            //
            Schema::drop('usCamion');
        });
    }
}
