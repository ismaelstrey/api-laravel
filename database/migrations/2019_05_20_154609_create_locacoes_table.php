<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locacoes', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('filme_id');
            $table->foreign('filme_id')->references('id')->on('filmes')->onUpdate('cascade')->onDelete('cascade');
            $table->date('data_locacao');
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
        Schema::table('locacoes', function (Blueprint $table) {
            $table->dropForeign(['filme_id']);
            $table->dropForeign(['cliente_id']);
            $table->dropIfExists('locacoes');
        });
    }
}
