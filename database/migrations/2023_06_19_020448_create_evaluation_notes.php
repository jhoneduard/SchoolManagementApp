<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_register')->unsigned();
            $table->bigInteger('id_evaluation')->unsigned();
            $table->integer('qualification');
            $table->dateTime('date_evaluation', 0);
            $table->foreign('id_register')
            ->references('id')
            ->on('registration_subjects')
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
        Schema::dropIfExists('evaluation_notes');
    }
}
