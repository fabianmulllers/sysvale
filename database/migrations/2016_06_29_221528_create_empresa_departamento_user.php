<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaDepartamentoUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_departamento_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->integer('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name_vale');
            $table->date('date_vale');
            $table->integer('total_product');
            $table->enum('aprobacion_vale',['si','no','espera']);
            $table->integer('bloqueo')->default(0);
            
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('empresa_departamento_users');
    }
}
