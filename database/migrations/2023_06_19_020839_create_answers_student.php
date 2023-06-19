<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers_student', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_cuestion')->unsigned();
            $table->bigInteger('id_answer_selected')->unsigned();
            $table->bigInteger('id_evaluation_note')->unsigned();

            $table->foreign('id_evaluation_note')
            ->references('id')
            ->on('evaluation_notes')
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
        Schema::dropIfExists('answers_student');
    }
}
