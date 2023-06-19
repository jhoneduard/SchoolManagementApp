<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_creation', 0);
            $table->bigInteger('id_subject')->unsigned();
            $table->dateTime('initial_date', 0);
            $table->dateTime('end_date', 0);
            $table->foreign('id_subject')
            ->references('id')
            ->on('subjects')
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
        Schema::dropIfExists('evaluation');
    }
}
