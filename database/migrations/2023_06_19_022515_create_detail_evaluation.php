<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_evaluation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_evaluation')->unsigned();
            $table->bigInteger('id_cuestion')->unsigned();
            $table->foreign('id_evaluation')
            ->references('id')
            ->on('evaluation')
            ->onDelete('restrict');
            $table->foreign('id_cuestion')
            ->references('id')
            ->on('cuestion')
            ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_evaluation');
    }
}
