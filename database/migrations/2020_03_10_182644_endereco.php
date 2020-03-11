<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Endereco extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('cep');
            $table->string('descricao');
            $table->string('endereco');
            $table->string('bairro');
            $table->string('numero');
            $table->string('complemento');
            $table->string('referencia');
            $table->string('cidade');
            $table->string('estado');
            $table->timestamps();
        });

        Schema::table('enderecos', function (Blueprint $table) {
            $table->unsignedBigInteger('cliente_id');
        
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('enderecos');
    }
}
