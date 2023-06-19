<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 90);
            $table->string('description', 100);
            $table->integer('number_registered');	
            $table->string('status', 100);
            $table->bigInteger('id_teacher')->unsigned();
            $table->bigInteger('id_category_subject')->unsigned();
            $table->dateTime('initial_date', 0);
            $table->dateTime('end_date', 0);
            $table->foreign('id_teacher')
            ->references('id')
            ->on('users')
            ->onDelete('restrict');
            $table->foreign('id_category_subject')
            ->references('id')
            ->on('category_subject')
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
        Schema::dropIfExists('subjects');
    }
}
