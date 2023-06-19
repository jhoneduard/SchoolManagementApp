<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registration_subjects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_subject')->unsigned();
            $table->bigInteger('id_student')->unsigned();
            $table->dateTime('date_registration', 0);
            $table->string('status', 100);
            $table->integer('qualification_end');

            $table->foreign('id_subject')
            ->references('id')
            ->on('subjects')
            ->onDelete('restrict');

            $table->foreign('id_student')
            ->references('id')
            ->on('users')
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
        Schema::dropIfExists('registration_subjects');
    }
}
