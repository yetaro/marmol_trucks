<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usca', function (Blueprint $table) {
            //
            $table->id();
            $table->foreignId('idUsuario')->constrained('users');
            $table->foreignId('idCamion')->constrained('camiones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usca', function (Blueprint $table) {
            //
            Schema::drop('usca');
        });
    }
}
